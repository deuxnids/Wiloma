<?php

namespace Ghw\WriterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ghw\MatchBundle\Entity\Request;


class DefaultController extends Controller
{
    public function indexAction()
    {
		$repository = $this->getDoctrine()
			->getManager()
			->getRepository('GhwMatchBundle:Request');

		$listeRequests = $repository->findAll();


        return $this->render('GhwWriterBundle::index.html.twig', array('listeRequests' => $listeRequests));
    }


	public function  requestAction($id)
	{

		$repository = $this->getDoctrine()
			->getManager()
			->getRepository('GhwMatchBundle:Request');

		$newRequest = $repository->findOneById($id);




		   $formBuilder = $this->createFormBuilder($newRequest);
        $formBuilder
        ->add('letter',        'textarea');
        $form = $formBuilder->getForm();
        $request = $this->get('request');

        if ($request->getMethod() == 'POST') {
          $form->bind($request);

          if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();

            $newRequest->setWriter($user);
            $em->persist($newRequest);
            $em->flush();
            //return $this->redirect($this->generateUrl('sdzblog_voir', array('id' => $newRequest->getId())));
          }
        }





		return $this->render('GhwWriterBundle::request.html.twig', array('request' => $newRequest, 'form' => $form->createView()));
	}

}
