<?php

namespace RecEnsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('RecEnsBundle:Default:index.html.twig');
    }
}
