<?php

namespace Ghw\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ghw\MatchBundle\Entity\Request;
use Ghw\UserBundle\Entity\User;



class DefaultController extends Controller
{
    public function indexAction()
    {
        $newRequest = new Request();
        $formBuilder = $this->createFormBuilder($newRequest);
        $formBuilder->add('description',        'textarea');
        $form = $formBuilder->getForm();
        $request = $this->get('request');

        if ($request->getMethod() == 'POST') {
          $form->bind($request);

          if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();

            $newRequest->setUser($user);
            $em->persist($newRequest);
            $em->flush();
            //return $this->redirect($this->generateUrl('sdzblog_voir', array('id' => $newRequest->getId())));
          }
        }

        return $this->render('GhwClientBundle::index.html.twig', array(
        'form' => $form->createView(),
        ));
    }
}
