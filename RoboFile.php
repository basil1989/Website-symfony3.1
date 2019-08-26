<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{
    function  loadDb(){
        $this->taskExecStack()
            ->stopOnFail()
            ->exec(" mysql -h mariadb -u root -pqwerty -e 'create database margharettest' ")
            ->exec(" mysql -h mariadb -u root -pqwerty margharettest < test.sql ")
            ->run();
    }


    function prepareDb(){
        $this->taskExecStack()
            ->stopOnFail()
            ->exec("cp  app/config/parameters-test.yml app/config/parameters.yml")
            ->run();

        $this->taskReplaceInFile('app/config/parameters.yml')
            ->from('database_host:     127.0.0.1')
            ->to("database_host:     'mariadb'")
            ->run();

        $this->taskReplaceInFile('app/config/parameters.yml')
            ->from('database_user:     dbuser')
            ->to("database_user:     'root'")
            ->run();

        $this->taskReplaceInFile('app/config/parameters.yml')
            ->from('database_password: 123')
            ->to("database_password: 'qwerty'")
            ->run();





    }


}