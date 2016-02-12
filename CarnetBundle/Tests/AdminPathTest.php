<?php
/**
 * Created by PhpStorm.
 * User: hazardl
 * Date: 22/01/2016
 * Time: 09:45
 */

namespace CarnetApp\CarnetBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class AdminPathTest extends WebTestCase{


    public function logIn($client, $username = 'test', $password = 'test')
    {
//        $client = static::createClient();

        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('_submit')->form(array(
            '_username' => $username,
            '_password' => $password,
        ));
        $client->submit($form);

        $this->assertTrue($client->getResponse()->isRedirect());
    }

    protected function createAuthorizedClient()
    {
        $client = static::createClient();
        $container = $client->getContainer();

        $session = $container->get('session');
        /** @var $userManager \FOS\UserBundle\Doctrine\UserManager */
        $userManager = $container->get('fos_user.user_manager');
        /** @var $loginManager \FOS\UserBundle\Security\LoginManager */
        $loginManager = $container->get('fos_user.security.login_manager');
        $firewallName = $container->getParameter('fos_user.firewall_name');

        $user = $userManager->findUserBy(array('username' => 'test'));
        $loginManager->loginUser($firewallName, $user);

        // save the login token into the session and put it in a cookie
        $container->get('session')->set('_security_' . $firewallName,
            serialize($container->get('security.context')->getToken()));
        $container->get('session')->save();
        $client->getCookieJar()->set(new Cookie($session->getName(), $session->getId()));

        return $client;
    }


    /**
     * @dataProvider urlProvider
     */
    public function testPageIsSuccessful($url)
    {

        $client = static::createClient();
        $this->logIn($client);

        $client->request('GET', $url);

//        $this->assertTrue($client->getResponse()->isSuccessful());
       // var_dump($client->getResponse()->getContent());
        die();
        $this->assertEquals(200 , $client->getResponse()->getStatusCode());
    }

    public function urlProvider()
    {
        return array(
            array('admin/carnet/'),
            array('admin/carnet/new'),
            array('admin/carnet/lieu/'),
            array('admin/carnet/lieu/new'),
            array('admin/carnet/page/'),
            array('admin/carnet/page/new'),
        );
    }

}
