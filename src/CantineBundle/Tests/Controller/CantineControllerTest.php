<?php

namespace CantineBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CantineControllerTest extends WebTestCase
{
    public function testAjouterplat()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ajouterPlat');
    }

    public function testAfficherplat()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/afficherPlat');
    }

    public function testModifierplat()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/modifierPlat');
    }

    public function testSupprimerplat()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/supprimerPlat');
    }

}
