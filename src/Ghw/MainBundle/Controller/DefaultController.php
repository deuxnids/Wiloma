<?php

namespace Ghw\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GhwMainBundle:Default:index.html.twig');
    }
}
