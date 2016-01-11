<?php
/**
 * Created by PhpStorm.
 * User: laurent
 * Date: 06/01/2016
 * Time: 10:08
 */

namespace CarnetApp\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class BlogCommentWriteTest extends WebTestCase
{

    public function testCompleteScenario()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', "/carnet/le-lounge/bienvenue");
        $this->assertEquals(200, $client->getResponse()->getStatusCode());


        $form = $crawler->selectButton('Create')->form(array(
            'carnetapp_blogbundle_comment[authorName]' => 'Test',
            'carnetapp_blogbundle_comment[contenu]' => 'plupTest',
        ));


//        $form = $crawler->selectButton('Create')->form(array(
//            'carnetsbundle_blogcomment[authorName]' => 'Test',
//            'carnetsbundle_blogcomment[authorMail]' => 'Test@test.fr',
//            'carnetsbundle_blogcomment[contenu]' => 'Test Test',
//            'carnetsbundle_blogcomment[arcticle]' => '1',
//            'carnetsbundle_blogcomment[reply]' => NULL
//        ));

        $client->submit($form);
        $client->followRedirect();


//        $this->assertGreaterThan(0, $crawler->filter('div.comment-text.color-grey:contains("plupTest")')->count(), 'Missing element div.comment-text.color-grey:contains("plupTest")');

//        die(var_dump($crawler));


    }
}
