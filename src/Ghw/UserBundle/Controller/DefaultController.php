<?php

namespace Ghw\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GhwUserBundle:Default:index.html.twig');
    }
}
