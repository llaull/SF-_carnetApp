<?php

namespace CarnetApp\StaticPageBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/carnet/le-lounge/');

        $this->assertTrue($crawler->filter('span:contains("blog")')->count() > 0);
    }
}
