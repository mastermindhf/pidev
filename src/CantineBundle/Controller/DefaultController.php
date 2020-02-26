<?php

namespace CantineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CantineBundle:Default:index.html.twig');
    }
}
