<?php

namespace CalendrierBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CalendrierBundle:Default:index.html.twig');
    }
}
