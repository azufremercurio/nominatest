<?php

namespace NominaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NominaBundle:Default:index.html.twig');
    }
}
