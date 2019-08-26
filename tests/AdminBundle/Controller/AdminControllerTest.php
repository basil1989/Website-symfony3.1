<?php
/**
 * Created by PhpStorm.
 * User: michal@glajc.pl
 * Date: 20.11.2016
 * Time: 20:01
 */

namespace AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;


class AdminControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    private function logIn($role=['ROLE_SUPERADMIN','ROLE_ADMIN'])
    {
        $session = $this->client->getContainer()->get('session');

        // the firewall context (defaults to the firewall name)
        $firewall = 'main';

        $token = new UsernamePasswordToken('admin', null, $firewall, $role);
        $session->set('_security_'.$firewall, serialize($token));
        $session->save();


        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }

      public  function testA(){
          $this->assertTrue(true);
      }

//
//    public function testSecuredIndex()
//    {
//        $this->logIn();
//
//        $url=$this->client->getContainer()->get('router')->generate('admin_default_index');
//        $crawler = $this->client->request('GET', $url);
//
//        $this->assertTrue($this->client->getResponse()->isSuccessful());
//        $this->assertGreaterThan(0, $crawler->filter('html:contains("GoodWebsite CMS")')->count());
//        $this->assertGreaterThan(0, $crawler->filter('html:contains("Static Pages")')->count());
//        $this->assertGreaterThan(0, $crawler->filter('html:contains("Email Templates")')->count());
//        $this->assertGreaterThan(0, $crawler->filter('html:contains("Users")')->count());
//        $this->assertGreaterThan(0, $crawler->filter('html:contains("Applications")')->count());
//
//    }
//
//    public function testSecuredStaticPages(){
//        $this->logIn();
//        $url=$this->client->getContainer()->get('router')->generate('admin_page_index');
//        $crawler = $this->client->request('GET', $url);
//        $this->assertGreaterThan(0, $crawler->filter('html:contains("Static Pages")')->count());
//        $this->assertGreaterThan(0, $crawler->filter('html:contains("Name")')->count());
//        $this->assertGreaterThan(0, $crawler->filter('html:contains("Options")')->count());
//        $pages=$this->client->getContainer()->getParameter('static_page');
//        foreach ($pages as $page){
//            $this->assertGreaterThan(0, $crawler->filter('html:contains("'.$page.'")')->count());
//        }
//    }
//
//    public function testSecuredEmailTemplates(){
//        $this->logIn();
//        $url=$this->client->getContainer()->get('router')->generate('admin_email_index');
//        $crawler = $this->client->request('GET', $url);
//        $this->assertGreaterThan(0, $crawler->filter('html:contains("Email Templates")')->count());
//        $this->assertGreaterThan(0, $crawler->filter('html:contains("Name")')->count());
//        $this->assertGreaterThan(0, $crawler->filter('html:contains("Options")')->count());
//        $templates=$this->client->getContainer()->getParameter('email_templates');
//        foreach ($templates as $template){
//            $this->assertGreaterThan(0, $crawler->filter('html:contains("'.$template.'")')->count());
//        }
//    }
//
//    public function testUsersAsSuperAdmin(){
//        $this->logIn();
//        $url=$this->client->getContainer()->get('router')->generate('admin_user_index');
//        $crawler = $this->client->request('GET', $url);
//        $this->assertGreaterThan(0, $crawler->filter('html:contains("Registered Users")')->count());
//    }
//
//
//
//    public function testApplication(){
//        $this->logIn();
//        $url=$this->client->getContainer()->get('router')->generate('admin_app_index');
//        $crawler = $this->client->request('GET', $url);
//        $this->assertGreaterThan(0, $crawler->filter('html:contains("Applications")')->count());
//        $this->assertGreaterThan(0, $crawler->filter('html:contains("Name")')->count());
//        $this->assertGreaterThan(0, $crawler->filter('html:contains("Caring pro")')->count());
//        $this->assertGreaterThan(0, $crawler->filter('html:contains("Created")')->count());
//        $this->assertGreaterThan(0, $crawler->filter('html:contains("Status")')->count());
//    }









}
