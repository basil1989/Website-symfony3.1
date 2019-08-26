<?php
/**
 * Created by PhpStorm.
 * User: joseph
 * Date: 16.12.16
 * Time: 10:36
 */

namespace AdminBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class CvsImportEvent extends Event
{
    private $data;

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }
}
