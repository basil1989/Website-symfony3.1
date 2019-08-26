<?php
/**
 * Created by PhpStorm.
 * User: joseph
 * Date: 16.12.16
 * Time: 11:16
 */

namespace AdminBundle\Command;

use AdminBundle\Event\CvsImportEvent;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportUserCommand extends ContainerAwareCommand
{
    private $em;
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('cms:import:user')

            // the short description shown while running "php bin/console list"
            ->setDescription('Import users from Data/caring_pro.csv')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp("Imports  user")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file=__DIR__.'/../../../Data/caring_pro.csv';
        if (!file_exists($file)) {
            throw new \Exception("File not exist");
        }
        $raw=file_get_contents($file);
        $event=new CvsImportEvent();
        $event->setData($raw);
        $dispatcher=$this->getContainer()->get('event_dispatcher');
        $dispatcher->dispatch('import.client', $event);
    }
}
