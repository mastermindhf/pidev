<?php

namespace CoursBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class QuizzControllerTest extends WebTestCase
{
    public function testPasserquiz()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/PasserQuiz');
    }

}
