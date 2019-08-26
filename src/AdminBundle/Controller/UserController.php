<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\User;
use AdminBundle\Form\UserTypeBackend;
use AdminBundle\Service\CacheAdapter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PageController
 * @package AdminBundle\Controller
 */
class UserController extends Controller
{
    const CACHE_CLASS = 'user';

    protected $cache;

    /**
     * ApplicationController constructor.
     * @param CacheAdapter $adapter
     * @param ContainerInterface $container
     */
    public function __construct(CacheAdapter $adapter, ContainerInterface $container)
    {
        parent::setContainer($container);
        $this->cache = $adapter;
    }

    /**
     * @Template()
     */
    public function indexAction()
    {
        return [];
    }

    /**
     * @Template()
     */
    public function dataTableAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $this->cache->getItem(self::CACHE_CLASS);

        if (!$users->isHit()) {
            $usersList = $em->getRepository('AdminBundle:User')->getUsersLow($this->get('router'));
            $users->set($usersList);
            $this->cache->save($users);
            $users = $usersList;
        } else {
            $users = $users->get();
        }

        return new JsonResponse(['data' => $users]);
    }

    /**
     * @ParamConverter(name="user", class="AdminBundle:User")
     */
    public function deleteAction(User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $userId = $user->getId();
        $em->remove($user);
        $em->flush();
        $this->cache->removeElementFromCache(self::CACHE_CLASS, $userId);

        return $this->redirectToRoute('admin_user_index');
    }

    /**
     * @ParamConverter(name="user", class="AdminBundle:User")
     */
    public function lockAction(User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $userId = $user->getId();
        $user->setEnabled(false);
        $em->flush();
        $this->cache->addElementFromCache(self::CACHE_CLASS, $user);

        return $this->redirectToRoute('admin_user_index');
    }

    /**
     * @ParamConverter(name="user", class="AdminBundle:User")
     */
    public function unlockAction(User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $userId = $user->getId();
        $user->setEnabled(true);
        $em->flush();
        $this->cache->addElementFromCache(self::CACHE_CLASS, $user);

        return $this->redirectToRoute('admin_user_index');
    }

    /**
     * @Route("/promote/{id}", name="admin_user_promote")
     * @ParamConverter(name="user", class="AdminBundle:User")
     */
    public function promoteAction(User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $userId = $user->getId();
        $user->setRoles(['ROLE_ADMIN']);
        $em->flush();
        $this->cache->addElementFromCache(self::CACHE_CLASS, $user);

        return $this->redirectToRoute('admin_user_index');
    }

    /**
     * @Route("/spromote/{id}", name="admin_user_spromote")
     * @ParamConverter(name="user", class="AdminBundle:User")
     * @Security("has_role('ROLE_SUPERADMIN')")
     */
    public function spromoteAction(User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $userId = $user->getId();
        $user->setRoles(['ROLE_SUPERADMIN']);
        $em->flush();
        $this->cache->addElementFromCache(self::CACHE_CLASS, $user);

        return $this->redirectToRoute('admin_user_index');
    }

    /**
     * @Route("/depromote/{id}", name="admin_user_depromote")
     * @ParamConverter(name="user", class="AdminBundle:User")
     */
    public function dePromoteAction(User $user)
    {
        $em = $this->getDoctrine()->getManager();

        $userId = $user->getId();
        $user->setRoles(['ROLE_USER']);
        $em->flush();
        $this->cache->addElementFromCache(self::CACHE_CLASS, $user);

        return $this->redirectToRoute('admin_user_index');
    }

    /**
     * @Route("/edit/{id}", name="admin_user_edit")
     * @ParamConverter(name="user", class="AdminBundle:User")
     * @Template()
     */
    public function editAction(User $user, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(UserTypeBackend::class, $user);
        if ($request->getMethod() == "POST") {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $userId = $user->getId();
                $em->flush();
                $this->cache->addElementFromCache(self::CACHE_CLASS, $user);

                return $this->redirectToRoute('admin_user_index');
            }
        }

        return ['user' => $user, 'form' => $form->createView()];
    }
}
