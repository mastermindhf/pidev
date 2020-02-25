<?php

namespace CoursBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NiveauControllerTest extends WebTestCase
{
    public function testAjouterniveau()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/AjouterNiveau');
    }

    public function testAfficherniveau()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/AfficherNiveau');
    }

    public function testModifierniveau()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ModifierNiveau');
    }

    public function testSupprimerniveau()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/SupprimerNiveau');
    }

}
