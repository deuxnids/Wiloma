<?php

namespace Ghw\MatchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('GhwMatchBundle:Default:index.html.twig', array('name' => $name));
    }
}
