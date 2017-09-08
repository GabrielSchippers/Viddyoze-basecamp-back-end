<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AuthorControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/author/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode(), 'Invalid Http Response to /author/');

        $crawler = $client->click($crawler->selectLink('Create')->link());
        $form = $crawler->selectButton('summit')->form();
        //set some values
        $form['author'] = 'Einstein';
        //submit the form
        $crawler = $client->submit($form);
        $this->assertGreaterThan(0, $crawler->filter('td:contains("Einstein")')->count(), 'Missing element td:contains("Einstein")');

        $crawler = $client->click($crawler->selectLink('Edit')->link());
        $form = $crawler->selectButton('summit')->form();
        //set some values
        $form['author'] = 'test';
        //submit the form
        $crawler = $client->submit($form);
        $this->assertGreaterThan(0, $crawler->filter('td:contains("test")')->count(), 'Missing element td:contains("test")');


        $form = $crawler->selectButton('Delete')->form();
        $crawler = $client->submit($form);
        $this->assertNotRegExp('/test/', $client->getResponse()->getContent());

    }
}
