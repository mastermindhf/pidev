<?php

namespace CalendrierBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CalendrierControllerTest extends WebTestCase
{
    public function testCreeremploi()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/creerEmploi');
    }

}
