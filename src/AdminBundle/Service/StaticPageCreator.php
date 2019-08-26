<?php

namespace AdminBundle\Service;

use AdminBundle\Entity\EmailTemplate;
use AdminBundle\Entity\Page;
use Doctrine\ORM\EntityManager;

/**
 *
 */
class StaticPageCreator
{
    private $em;
    private $pages;
    private $templates;

    /**
     * StaticPageCreator constructor.
     * @param $em
     */
    public function __construct(EntityManager $em, $pages, $templates)
    {
        $this->em = $em;
        $this->pages=$pages;
        $this->templates=$templates;
    }

    public function check()
    {
        foreach ($this->pages as $page) {
            $p=$this->em->getRepository("AdminBundle:Page")->findOneByName($page);
            if (!$p) {
                $p=new Page();
                $p->setName($page);
                $p->setTitle($page);
                $this->em->persist($p);
                $this->em->flush();
            }
        }
    }

    public function checkTemplates()
    {
        foreach ($this->templates as $tmp) {
            $p=$this->em->getRepository("AdminBundle:EmailTemplate")->findOneByName($tmp);
            if (!$p) {
                $p=new EmailTemplate();
                $p->setName($tmp);
                $p->setTopic($tmp);
                $this->em->persist($p);
                $this->em->flush();
            }
        }
    }
}
