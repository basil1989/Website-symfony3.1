<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Link;
use AdminBundle\Form\LinkType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/links")
 * @Security("has_role('ROLE_SUPERADMIN')")
 */
class LinkController extends Controller
{
    /**
     * @Template()
     * @Route("/index" ,name="admin_link_index")
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $links=$em->getRepository("AdminBundle:Link")->findAll();
        return array('links'=>$links);
    }

    /**
     * @Template()
     * @Route("/add" ,name="admin_link_add")
     */
    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $link=new Link();
        $form=$this->createForm(LinkType::class, $link);
        if ($request->getMethod()=='POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->persist($link);
                $em->flush();
                return $this->redirectToRoute('admin_link_index');
            }
        }

        return array('form'=>$form->createView());
    }

    /**
     * @Template()
     * @ParamConverter(name="link", class="AdminBundle:Link")
     * @Route("/edit/{id}", name="admin_link_edit")
     */
    public function editAction(Link $link, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $form=$this->createForm(LinkType::class, $link);
        if ($request->getMethod()=='POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->flush();
                return $this->redirectToRoute('admin_link_index');
            }
        }
        return array('form'=>$form->createView(),'link'=>$link);
    }

    /**
     * @ParamConverter(name="link", class="AdminBundle:Link")
     * @Route("/del/{id}" ,name="admin_link_del")
     */
    public function delAction(Link $link)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($link);
        $em->flush();
        return $this->redirectToRoute('admin_link_index');
    }


    /**
     * @Template()
     * @ParamConverter(name="link", class="AdminBundle:Link")
     * @Route("/images-{id}", name="admin_link_images")
     */
    public function imagesAction(Link $link, Request $request)
    {
        $link->checkDir();
        $images=$link->getImages();

        if ($request->getMethod()=='POST') {
            $file=$request->files->all()['plik'];
            $link->UploadFile($file);
        }
        return array('link'=>$link,'images'=>$images);
    }

    /**
     * @param Link $link
     * @param $file
     * @ParamConverter(name="link", class="AdminBundle:Link")
     * @Route("/delimage/{id}/{file}", name="admin_link_image_del")
     */
    public function delImage(Link $link, $file)
    {
        $link->removeImage($file);
        return $this->redirectToRoute('admin_link_images', ['id'=>$link->getId()]);
    }
}
