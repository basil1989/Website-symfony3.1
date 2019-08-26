<?php
/**
 * Created by PhpStorm.
 * User: michal@glajc.pl
 * Date: 20.11.2016
 * Time: 20:01
 */

namespace MargaretBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class FrontendControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $url=$client->getContainer()->get('router')->generate('frontend_index');
        $crawler = $client->request('GET', $url);
        $this->assertTrue($client->getResponse()->isSuccessful(), 'response status is 2xx');
    }

    public function howIndex()
    {
        $client = static::createClient();
        $url=$client->getContainer()->get('router')->generate('frontend_how');
        $crawler = $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful(), 'response status is 2xx');
    }

    public function testCommon()
    {
        $client = static::createClient();
        $url=$client->getContainer()->get('router')->generate('frontend_common');
        $crawler = $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful(), 'response status is 2xx');
    }

    public function testApply()
    {
        $client = static::createClient();
        $url=$client->getContainer()->get('router')->generate('frontend_apply');
        $crawler = $client->request('GET', $url);
        $this->assertFalse($client->getResponse()->isSuccessful(), 'response status is 2xx');
    }

    public function testDonate()
    {
        $client = static::createClient();
        $url=$client->getContainer()->get('router')->generate('frontend_donate');
        $crawler = $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful(), 'response status is 2xx');
    }

    public function testContact()
    {
        $client = static::createClient();
        $url=$client->getContainer()->get('router')->generate('frontend_contact');
        $crawler = $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful(), 'response status is 2xx');
    }


    public function testLinks()
    {
        $client = static::createClient();
        $url=$client->getContainer()->get('router')->generate('frontend_links');
        $crawler = $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful(), 'response status is 2xx');
    }

    public function testUserLogin()
    {
        $client = static::createClient();
        $url=$client->getContainer()->get('router')->generate('fos_user_security_login');
        $crawler = $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful(), 'response status is 2xx');
    }


    public function testThank()
    {
        $client = static::createClient();
        $url=$client->getContainer()->get('router')->generate('frontend_thanks');
        $crawler = $client->request('GET', $url);
        $this->assertTrue($client->getResponse()->isSuccessful(), 'response status is 2xx');

    }







}
