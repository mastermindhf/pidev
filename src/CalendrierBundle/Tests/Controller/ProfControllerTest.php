<?php

namespace CalendrierBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProfControllerTest extends WebTestCase
{
    public function testAjouterprof()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ajouterProf');
    }

}
