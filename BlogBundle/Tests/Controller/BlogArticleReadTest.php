<?php
/**
 * Created by PhpStorm.
 * User: laurent
 * Date: 06/01/2016
 * Time: 10:08
 */

namespace CarnetApp\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class BlogArticleReadTest extends WebTestCase{

    public function testCompleteScenario()
    {
        $client = static::createClient();

        $client->request('GET', "/nos-voyages");
        $this->assertEquals(200 , $client->getResponse()->getStatusCode());
    }
}