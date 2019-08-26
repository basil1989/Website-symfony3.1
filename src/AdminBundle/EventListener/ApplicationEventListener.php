<?php
/**
 * Created by PhpStorm.
 * User: michal@glajc.pl
 * Date: 24.11.2016
 * Time: 21:02
 */

namespace AdminBundle\EventListener;

use AdminBundle\Form\ApplicationType;
use Doctrine\ORM\EntityManager;
use MargaretBundle\Event\ApplicationEvent;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;

class ApplicationEventListener
{
    private $mailer;
    private $adminemail;
    private $em;
    private $flash;
    private $twig;
    private $from;


    /**
     * ApplicationEventListener constructor.
     * @param $mailer
     */
    public function __construct(
        \Swift_Mailer $mailer,
        $adminemail,
        EntityManager $em,
        FlashBag $flash,
        \Twig_Environment $twig_Environment,
        $from,
        FormFactory $formFactory
    ) {
        $this->adminemail = $adminemail;
        $this->mailer = $mailer;
        $this->em = $em;
        $this->twig = $twig_Environment;
        $this->from = $from;
        $this->form = $formFactory;
    }

    public function sendEmailToUserOnNewApp(ApplicationEvent $event)
    {
        $app = $event->getApplication();

        $message = \Swift_Message::newInstance()
            ->setSubject('New Application')
            ->setFrom($this->from)
            ->setTo($app->getUser()->getEmail())
            ->setBody(
                $this->twig->render(
                    'AdminBundle:Emails:applicationNew.html.twig',
                    array( 'app' => $app )
                ),
                'text/html'
            );

        $this->mailer->send($message);
    }

    public function sendEmailToAdminOnNewApp(ApplicationEvent $event)
    {
        $app = $event->getApplication();

        $message = \Swift_Message::newInstance()
            ->setSubject('New Application - #'.$app->getId())
            ->setFrom($this->from)
            ->setTo($this->adminemail)
            ->setBody(
                $this->twig->render(
                    'AdminBundle:Emails:applicationNewToAdmin.html.twig',
                    array( 'app' => $app )
                ),
                'text/html'
            );

        $this->mailer->send($message);
    }

    public function lockApp(ApplicationEvent $event)
    {
        $app = $event->getApplication();
        $app->setLocked(true);
        $this->em->flush();
    }

    public function sendEmailToUserOnWithdrawnApp(ApplicationEvent $event)
    {
        $app = $event->getApplication();

        $message = \Swift_Message::newInstance()
            ->setSubject('Application Withdrawn')
            ->setFrom($this->from)
            ->setTo($app->getUser()->getEmail())
            ->setBody(
                $this->twig->render(
                    'AdminBundle:Emails:applicationWithdrawn.html.twig',
                    array( 'app' => $app )
                ),
                'text/html'
            );

        $this->mailer->send($message);
    }

    public function sendEmailToAdminOnWithdrawnApp(ApplicationEvent $event)
    {
        $app = $event->getApplication();

        $message = \Swift_Message::newInstance()
            ->setSubject('Application Withdrawn - #'.$app->getId())
            ->setFrom($this->from)
            ->setTo($this->adminemail)
            ->setBody(
                $this->twig->render(
                    'AdminBundle:Emails:applicationWithdrawnToAdmin.html.twig',
                    array( 'app' => $app )
                ),
                'text/html'
            );

        $this->mailer->send($message);
    }

    public function sendEmailToUserOnPledgedApp(ApplicationEvent $event)
    {
        $app = $event->getApplication();

        $message = \Swift_Message::newInstance()
            ->setSubject('Application Pledged')
            ->setFrom($this->from)
            ->setTo($app->getUser()->getEmail())
            ->setBody(
                $this->twig->render(
                    'AdminBundle:Emails:applicationPledged.html.twig',
                    array( 'app' => $app )
                ),
                'text/html'
            );

        $this->mailer->send($message);
    }

    public function sendEmailToAdminOnPledgedApp(ApplicationEvent $event)
    {
        $app = $event->getApplication();

        $message = \Swift_Message::newInstance()
            ->setSubject('Application Pledged - #'.$app->getId())
            ->setFrom($this->from)
            ->setTo($this->adminemail)
            ->setBody(
                $this->twig->render(
                    'AdminBundle:Emails:applicationPledgedToAdmin.html.twig',
                    array( 'app' => $app )
                ),
                'text/html'
            );

        $this->mailer->send($message);
    }

    public function sendEmailToUserOnWaitingApp(ApplicationEvent $event)
    {
        $app = $event->getApplication();

        $message = \Swift_Message::newInstance()
            ->setSubject('Application Pending: Waiting for Details')
            ->setFrom($this->from)
            ->setTo($app->getUser()->getEmail())
            ->setBody(
                $this->twig->render(
                    'AdminBundle:Emails:applicationPending.html.twig',
                    array( 'app' => $app )
                ),
                'text/html'
            );

        $this->mailer->send($message);
    }

    public function sendEmailToAdminOnWaitingApp(ApplicationEvent $event)
    {
        $app = $event->getApplication();

        $message = \Swift_Message::newInstance()
            ->setSubject('Application Pending - #'.$app->getId())
            ->setFrom($this->from)
            ->setTo($this->adminemail)
            ->setBody(
                $this->twig->render(
                    'AdminBundle:Emails:applicationPendingToAdmin.html.twig',
                    array( 'app' => $app )
                ),
                'text/html'
            );

        $this->mailer->send($message);
    }

    public function sendEmailToUserOnApprovedApp(ApplicationEvent $event)
    {
        $app = $event->getApplication();

        $message = \Swift_Message::newInstance()
            ->setSubject('Application Approved')
            ->setFrom($this->from)
            ->setTo($app->getUser()->getEmail())
            ->setBody(
                $this->twig->render(
                    'AdminBundle:Emails:applicationApproved.html.twig',
                    array( 'app' => $app )
                ),
                'text/html'
            );

        $this->mailer->send($message);
    }

    public function sendEmailToAdminOnApprovedApp(ApplicationEvent $event)
    {
        $app = $event->getApplication();

        $message = \Swift_Message::newInstance()
            ->setSubject('Application Approved - #'.$app->getId())
            ->setFrom($this->from)
            ->setTo($this->adminemail)
            ->setBody(
                $this->twig->render(
                    'AdminBundle:Emails:applicationApprovedToAdmin.html.twig',
                    array( 'app' => $app )
                ),
                'text/html'
            );

        $this->mailer->send($message);
    }

    public function sendEmailToUserOnRejectedApp(ApplicationEvent $event)
    {
        $app = $event->getApplication();

        $message = \Swift_Message::newInstance()
            ->setSubject('Application Rejected')
            ->setFrom($this->from)
            ->setTo($app->getUser()->getEmail())
            ->setBody(
                $this->twig->render(
                    'AdminBundle:Emails:applicationRejected.html.twig',
                    array( 'app' => $app )
                ),
                'text/html'
            );

        $this->mailer->send($message);
    }


    public function sendEmailToAdminOnRejectedApp(ApplicationEvent $event)
    {
        $app = $event->getApplication();

        $message = \Swift_Message::newInstance()
            ->setSubject('Application Rejected - #' .$app->getId())
            ->setFrom($this->from)
            ->setTo($this->adminemail)
            ->setBody(
                $this->twig->render(
                    'AdminBundle:Emails:applicationRejectedToAdmin.html.twig',
                    array( 'app' => $app )
                ),
                'text/html'
            );

        $this->mailer->send($message);
    }
}
