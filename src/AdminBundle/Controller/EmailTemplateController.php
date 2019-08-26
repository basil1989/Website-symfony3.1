<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\EmailTemplate;
use AdminBundle\Form\EmailTemplateType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class EmailTemplateController
 * @package AdminBundle\Controller
 * @Route("/emailtemplate")
 *
 */
class EmailTemplateController extends Controller
{
    /**
     *
     * @Route("/", name="admin_email_index")
     * @Template()
     * @Security("has_role('ROLE_SUPERADMIN')")
     */
    public function indexAction()
    {
        $this->get('creator')->checkTemplates();
        $em = $this->getDoctrine()->getManager();
        $templates=$em->getRepository("AdminBundle:EmailTemplate")->findAll();
        return ['templates'=>$templates];
    }

    /**
     * @Template()
     * @ParamConverter("template", class="AdminBundle:EmailTemplate")
     * @Route("/edit/{id}" ,name="admin_email_edit")
     */
    public function editAction(EmailTemplate $template, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $form=$this->createForm(EmailTemplateType::class, $template);
        if ($request->getMethod()=="POST") {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->flush();
                return $this->redirectToRoute('admin_email_index');
            }
        }

        return ['template'=>$template,'form'=>$form->createView()];
    }
}
