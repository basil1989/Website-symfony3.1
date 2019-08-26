<?php

namespace MargaretBundle\Event;
use Symfony\Component\EventDispatcher\Event;

/**
 * Created by PhpStorm.
 * User: michal@glajc.pl
 * Date: 24.11.2016
 * Time: 20:55
 */
class ApplicationEvent extends Event
{
    private $application;

    /**
     * ApplicationEvent constructor.
     * @param $application
     */
    public function __construct($application)
    {
        $this->application = $application;
    }


    /**
     * @return mixed
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * @param mixed $application
     */
    public function setApplication($application)
    {
        $this->application = $application;
    }




}