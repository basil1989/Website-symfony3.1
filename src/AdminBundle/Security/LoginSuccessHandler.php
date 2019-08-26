<?php

namespace AdminBundle\Security;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    protected $router;
    protected $authorizationChecker;
    protected $cache;

    public function __construct(Router $router, AuthorizationChecker $authorizationChecker, FilesystemAdapter $cache)
    {
        $this->router = $router;
        $this->authorizationChecker = $authorizationChecker;
        $this->cache=$cache;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $response = null;

        if ($this->authorizationChecker->isGranted('ROLE_SUPERADMIN')) {
            $this->cache->clear();
            $response = new RedirectResponse($this->router->generate('admin_default_index'));
        } elseif ($this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            $response = new RedirectResponse($this->router->generate('frontend_apply'));
        } elseif ($this->authorizationChecker->isGranted('ROLE_USER')) {
            $response = new RedirectResponse($this->router->generate('frontend_apply'));
        } else {
            $response = new RedirectResponse($this->router->generate('frontend_index'));
        }

        return $response;
    }
}
