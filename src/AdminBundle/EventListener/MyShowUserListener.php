<?php
/**
 * Created by PhpStorm.
 * User: joseph
 * Date: 06.11.16
 * Time: 22:21
 */

namespace AdminBundle\EventListener;

use Avanzu\AdminThemeBundle\Event\ShowUserEvent;
use Avanzu\AdminThemeBundle\Model\UserModel;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class MyShowUserListener
{
    private $token;

    /**
     * MyShowUserListener constructor.
     * @param $token
     */
    public function __construct(TokenStorage $token)
    {
        $this->token = $token;
    }


    public function onShowUser(ShowUserEvent $event)
    {
        $user = $this->getUser();
        $event->setUser($user);
    }

    protected function getUser()
    {
        $logged=$this->token->getToken()->getUser();
        $user=new UserModel('name', null, null, 'true', $logged->getUsername(), '');
        return $user;
    }
}
