<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('AdminBundle:Application:index.html.twig');
    }

    /**
     * @Route("/cache/", name="admin_cache")
     */
    public function cacheAction(Request $request)
    {
        $request->getSession()->getFlashBag()->add('success', 'Cache has been cleared');
        $this->get('cache.app')->clear();
        return $this->redirectToRoute('admin_default_index');
    }
}
