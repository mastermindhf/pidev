<?php

namespace SuiviEnsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@SuiviEns/Default/index.html.twig');
    }
}
