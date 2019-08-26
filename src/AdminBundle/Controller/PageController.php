<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Page;
use AdminBundle\Form\PageType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PageController
 * @package AdminBundle\Controller
 * @Route("/page")
 * @Security("has_role('ROLE_SUPERADMIN')")
 */
class PageController extends Controller
{
    /**
     * @Route("/", name="admin_page_index")
     * @Template()
     */
    public function indexAction()
    {
        $this->get('creator')->check();
        $em = $this->getDoctrine()->getManager();
        $pages=$em->getRepository('AdminBundle:Page')->findAll();
        return ['pages'=>$pages];
    }

    /**
     * @Route("/edit/{id}", name="admin_page_edit")
     * @ParamConverter(name="page", class="AdminBundle:Page")
     * @Template()
     */
    public function editAction(Page $page, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $form=$this->createForm(PageType::class, $page);
        if ($request->getMethod()=="POST") {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->flush();
                return $this->redirectToRoute('admin_page_index');
            }
        }

        return ['page'=>$page,'form'=>$form->createView()];
    }
}
