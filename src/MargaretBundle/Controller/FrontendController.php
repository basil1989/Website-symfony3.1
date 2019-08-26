<?php

namespace MargaretBundle\Controller;

use AdminBundle\Entity\Application;
use AdminBundle\Form\ApplicationType;
use AdminBundle\Form\ApplicationEditType;
use MargaretBundle\Event\ApplicationEvent;
use MargaretBundle\Form\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;

class FrontendController extends Controller
{

	/**
	 * @Route("/admin.php/")
	 */
	public function redirectAction()
	{
		return $this->redirectToRoute('admin_default_index');
	}

	/**
	 * @Template()
	 * @Route("/", name="frontend_index" )
	 * @return array
	 *
	 */
	public function indexAction()
	{
		$em   = $this->getDoctrine()->getManager();
		$page = $em->getRepository("AdminBundle:Page")->findOneByName('About');

		return array('page' => $page);
	}

	/**
	 * @Template()
	 * @Route("/how-we-help.html", name="frontend_how" )
	 * @return array
	 */
	public function howAction()
	{
		$em   = $this->getDoctrine()->getManager();
		$page = $em->getRepository("AdminBundle:Page")->findOneByName('How We Help');

		return array('page' => $page);
	}

	/**
	 * @Template()
	 * @Route("/common-questions.html", name="frontend_common" )
	 * @return array
	 */
	public function commonAction()
	{
		$em   = $this->getDoctrine()->getManager();
		$page = $em->getRepository("AdminBundle:Page")->findOneByName('Common Questions');

		return array('page' => $page);
	}


	/**
	 * @Template()
	 * @Route("/appply-for-funds.html", name="frontend_apply" )
	 * @Security("has_role('ROLE_USER')")
	 * @return array
	 */
	public function applyAction(Request $request)
	{
		$user = $this->getUser();
		if ($user->getGdpr() == 0) {
			header('Location: https://www.margaretsfund.org/gdpr.php?mail='.$user->getEmail());
			exit();
		}

		$application = new Application();
		$em          = $this->getDoctrine()->getManager();
		$form        = $this->createForm(ApplicationType::class, $application);
		if ($request->getMethod() == "POST") {
			$form->handleRequest($request);
			if ($form->isValid()) {
				$user = $this->get("security.token_storage")->getToken()->getUser();
				$application->setUser($user);
				$em->persist($application);
				$em->flush();
				$event = new ApplicationEvent($application);
				$this->get("event_dispatcher")->dispatch('new.application', $event);

				return $this->redirectToRoute('frontend_thanks');
			}
		}

		return array('form' => $form->createView());

	}

	/**
	 * @Template()
	 * @Route("/previous.html",name="frontend_previous")
	 * @Security("has_role('ROLE_USER')")
	 */
	public function previousAction()
	{
		$user = $this->get('security.token_storage')->getToken()->getUser();
		$em   = $this->getDoctrine()->getManager();
		$apps = $em->getRepository('AdminBundle:Application')->findBy(['user' => $user->getId()], ['id' => 'DESC']);

		return ['apps' => $apps];
	}


	/**
	 * @Template()
	 * @Route("/previous/edit/{id}",name="frontend_previous_edit")
	 * @Security("has_role('ROLE_USER')")
	 */
	public function editPreviousAction(Application $app, Request $request)
	{
		$application = $this->getDoctrine()
		                    ->getRepository("AdminBundle:Application")
		                    ->findBy(
			                    array(
				                    'user' => $this->get('security.token_storage')->getToken()->getUser()->getId(),
				                    'id'   => $app
			                    )
		                    );

		$form = $this->createForm(ApplicationEditType::class, $application[0]);

		if ($request->getMethod() == "POST") {
			$form->handleRequest($request);

			if ($form->isSubmitted() && $form->isValid()) {
				$em          = $this->getDoctrine()->getManager();
				$application = $em->getRepository('AdminBundle:Application')->find($app);

				$em->flush();

				return $this->redirectToRoute('frontend_previous');
			}
		}

		return array('form' => $form->createView());
	}


	/**
	 * @Template()
	 * @Route("/previous/view/{idApp}",name="frontend_previous_view")
	 * @Security("has_role('ROLE_USER')")
	 */
	public function viewPreviousAction($idApp, Request $request)
	{
		$application = $this->getDoctrine()
		                    ->getRepository("AdminBundle:Application")
		                    ->findBy(
			                    array(
				                    'user' => $this->get('security.token_storage')->getToken()->getUser()->getId(),
				                    'id'   => $idApp
			                    )
		                    );

		return array('app' => $application[0]);
	}


	/**
	 * @Template()
	 * @Route("/thankyou.html", name="frontend_thanks");
	 */
	public function thanksAction()
	{
		return array();
	}

	/**
	 * @Template()
	 * @Route("/updated.html", name="frontend_updated");
	 */
	public function updatedAction()
	{
		return array();
	}


	/**
	 * @Template()
	 * @Route("/deleted.html/{idForm}", name="frontend_deleted");
	 */
	public function deletedAction($idForm)
	{
		$em          = $this->getDoctrine()->getManager();
		$application = $this->getDoctrine()
		                    ->getRepository("AdminBundle:Application")
		                    ->findBy(
			                    array(
				                    'user' => $this->get('security.token_storage')->getToken()->getUser()->getId(),
				                    'id'   => $idForm
			                    )
		                    );
		$em->remove($application[0]);
		$em->flush();

		return array();
	}

	/**
	 * @Template()
	 * @Route("/donate.html", name="frontend_donate" )
	 * @return array
	 */
	public function donateAction()
	{
		$em   = $this->getDoctrine()->getManager();
		$page = $em->getRepository("AdminBundle:Page")->findOneByName('Donate to Margaret\'s Fund');

		return array('page' => $page);
	}

	/**
	 * @Template()
	 * @Route("/contact.html", name="frontend_contact" )
	 * @return array
	 */
	public function contactAction(Request $request)
	{
		$em   = $this->getDoctrine()->getManager();
		$page = $em->getRepository("AdminBundle:Page")->findOneByName('Contact Us');
		$data = array();
		$form = $this->createForm(ContactType::class, $data);
		if ($request->getMethod() == "POST") {
			// TODO: email send
		}

		return array('page' => $page, 'form' => $form->createView());
	}

	/**
	 * @Template()
	 * @Route("/links.html", name="frontend_links" )
	 * @return array
	 */
	public function linksAction()
	{
		$em    = $this->getDoctrine()->getManager();
		$page  = $em->getRepository("AdminBundle:Page")->findOneByName('Links');
		$links = $em->getRepository("AdminBundle:Link")->findAll();

		return array('page' => $page, 'links' => $links);
	}

	/**
	 * @Template()
	 * @Route("/list.html", name="frontend_list" )
	 * @Security("has_role('ROLE_USER')")
	 * @return array
	 */
	public function listAction(Request $request)
	{
		$em    = $this->getDoctrine()->getManager();
		$page  = $em->getRepository("AdminBundle:Page")->findOneByName('List Forms');
		$links = $em->getRepository("AdminBundle:Link")->findAll();

		$user    = $this->get('security.token_storage')->getToken()->getUser();
		$user_id = $user->getId();

		$listForms = $this->getDoctrine()
		                  ->getRepository("AdminBundle:Application")->findBy(array('user' => $user_id));

		return array('page' => $page, 'links' => $links, 'listForms' => $listForms);
	}


	/**
	 * @Template()
	 * @Route("/editAplication/{idForm}", name="frontend_edit" )
	 * @Security("has_role('ROLE_USER')")
	 * @return array
	 */
	public function editFormAction($idForm, Request $request)
	{
		$application = $this->getDoctrine()
		                    ->getRepository("AdminBundle:Application")
		                    ->findBy(
			                    array(
				                    'user' => $this->get('security.token_storage')->getToken()->getUser()->getId(),
				                    'id'   => $idForm
			                    )
		                    );

		$form = $this->createForm(ApplicationEditType::class, $application[0]);

		if ($request->getMethod() == "POST") {
			$form->handleRequest($request);

			if ($form->isSubmitted() && $form->isValid()) {
				$em          = $this->getDoctrine()->getManager();
				$application = $em->getRepository('AdminBundle:Application')->find($idForm);

				$em->flush();

				return $this->redirectToRoute('frontend_updated');
			}
		}

		return array('form' => $form->createView());
	}
}
