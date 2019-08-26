<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Application;
use AdminBundle\Form\ApplicationType;
use AdminBundle\Service\CacheAdapter;
use MargaretBundle\Event\ApplicationEvent;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ApplicationController
 * @package AdminBundle\Controller
 */
class ApplicationController extends Controller
{
    const CACHE_CLASS = 'app';

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
    public function getTableData()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $apps = $this->cache->getItem(self::CACHE_CLASS);

        if (!$apps->isHit()) {
            $applications = $entityManager->getRepository('AdminBundle:Application')->getApplications(
                false,
                $this->get('service_container')
            );

            $apps->set($applications);
            $this->cache->save($apps);
            $apps = $applications;
        } else {
            $apps = $apps->get();
        }

        return new JsonResponse(['data' => $apps]);
    }


    /**
     * @Template()
     */
    public function getTableDataLow()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $apps = $this->cache->getItem(self::CACHE_CLASS);

        if (!$apps->isHit()) {
            $applications = $entityManager->getRepository('AdminBundle:Application')->getAllApplicationsLow(
                $this->get('service_container')
            );

            $apps->set($applications);
            $this->cache->save($apps);
            $apps = $applications;
        } else {
            $apps = $apps->get();
        }

        return new JsonResponse(['data' => $apps]);
    }

    /**
     * @ParamConverter(name="application", class="AdminBundle:Application"  )
     * @Template()
     */
    public function showAction(Application $application)
    {
        return ['app' => $application];
    }

    /**
     * @ParamConverter(name="application", class="AdminBundle:Application"  )
     */
    public function delAction(Application $application)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $roles = $user->getRoles();

        $applicationId = $application->getId();

        if (in_array('ROLE_SUPERADMIN', $roles) || $application->getUser() == $user) {
            $em->remove($application);
            try {
                $em->flush();
                $this->cache->removeElementFromCache(self::CACHE_CLASS, $applicationId);
            } catch (\Exception $exception) {
                throw new \Exception('Something terrible happened! Please contact administrator');
            }
        }

        return $this->redirectToRoute('admin_app_index');
    }

    /**
     * @Template()
     * @ParamConverter(name="application", class="AdminBundle:Application"  )
     */
    public function edit(Application $application, Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $roles = $user->getRoles();

        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(ApplicationType::class, $application);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                if (in_array('ROLE_SUPERADMIN', $roles) || $application->getUser() == $user) {
                    $em->flush();
                    $this->cache->addElementFromCache(self::CACHE_CLASS, $application);
                }

                return $this->redirectToRoute("admin_app_index");
            }
        }


        return array('application' => $application, 'form' => $form->createView());
    }


    /**
     * @Template()
     * @ParamConverter(name="application", class="AdminBundle:Application"  )
     */
    public function editMy(Application $application, Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $roles = $user->getRoles();

        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(ApplicationType::class, $application);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                if (in_array('ROLE_USER', $roles) || $application->getUser() == $user) {
                    $em->flush();
                    $this->cache->addElementFromCache(self::CACHE_CLASS, $application);
                }

                return $this->redirectToRoute("admin_app_index");
            }
        }


        return array('application' => $application, 'form' => $form->createView());
    }


    /**
     * @Template()
     * @ParamConverter(name="application", class="AdminBundle:Application"  )
     */
    public function printit(Application $application, Request $request)
    {
        return array( 'app' => $application );
    }

    /**
     * @Template()
     * @ParamConverter(name="application", class="AdminBundle:Application"  )
     */
    public function viewAction(Application $application, Request $request)
    {
        return array('application' => $application);
    }

    /**
     * @ParamConverter(name="application", class="AdminBundle:Application"  )
     */
    public function waitAction(Application $application)
    {
        $em = $this->getDoctrine()->getManager();

        $application->setStatus('waiting');

        $em->flush();
        $this->cache->addElementFromCache(self::CACHE_CLASS, $application);

        $event = new ApplicationEvent($application);
        $this->get("event_dispatcher")->dispatch('waiting.application', $event);


        return $this->redirectToRoute('admin_app_index');
    }

    /**
     * @ParamConverter(name="application", class="AdminBundle:Application"  )
     */
    public function approveAction(Application $application)
    {
        $em = $this->getDoctrine()->getManager();

        $application->setStatus('approved');

        $em->flush();
        $this->cache->addElementFromCache(self::CACHE_CLASS, $application);

        $event = new ApplicationEvent($application);
        $this->get("event_dispatcher")->dispatch('approve.application', $event);


        return $this->redirectToRoute('admin_app_index');
    }

    /**
     * @ParamConverter(name="application", class="AdminBundle:Application"  )
     */
    public function withdrawAction(Application $application)
    {
        $em = $this->getDoctrine()->getManager();

        $application->setStatus('withdrawn');

        $em->flush();
        $this->cache->addElementFromCache(self::CACHE_CLASS, $application);

        $event = new ApplicationEvent($application);
        $this->get("event_dispatcher")->dispatch('withdraw.application', $event);

        return $this->redirectToRoute('admin_app_index');
    }

    /**
     * @ParamConverter(name="application", class="AdminBundle:Application"  )
     */
    public function pledgeAction(Application $application)
    {
        $em = $this->getDoctrine()->getManager();

        $application->setStatus('pledged');

        $em->flush();
        $this->cache->addElementFromCache(self::CACHE_CLASS, $application);

        $event = new ApplicationEvent($application);
        $this->get("event_dispatcher")->dispatch('pledge.application', $event);

        return $this->redirectToRoute('admin_app_index');
    }

    /**
     * @ParamConverter(name="application", class="AdminBundle:Application"  )
     */
    public function rejectAction(Application $application)
    {
        $em = $this->getDoctrine()->getManager();

        $application->setStatus('rejected');
        $em->flush();
        $this->cache->addElementFromCache(self::CACHE_CLASS, $application);
        $event = new ApplicationEvent($application);
        $this->get("event_dispatcher")->dispatch('reject.application', $event);


        return $this->redirectToRoute('admin_app_index');
    }
}
