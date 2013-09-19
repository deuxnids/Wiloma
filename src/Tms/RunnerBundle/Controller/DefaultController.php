<?php

namespace Tms\RunnerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Tms\RunnerBundle\Entity\Runner;

class DefaultController extends Controller
{
    public function indexAction()
    {
		$runner = new Runner;


		$formBuilder = $this->createFormBuilder($runner);
 		$formBuilder
			->add('lastName',        'text')
			->add('firstName', 'text')
			->add('code', 'text');

 
	  	$form = $formBuilder->getForm();

		$request = $this->get('request');


		if ($request->getMethod() == 'POST' ) {

	        $form->bind($request);

			if ($form->isValid()) {
				$em = $this->getDoctrine()->getManager();

				$em->persist($runner);
				$em->flush();
			    return $this->redirect($this->generateUrl('tms_runner_listAll'));

		    }
	    }
		$repository = $this->getDoctrine()
			->getManager()
			->getRepository('TmsRunnerBundle:Runner');

		$runner_list = $repository->findAll();

    	return $this->render('TmsRunnerBundle:Default:index.html.twig',
						array(		'form' 	=> $form->createView(),
									'runner_list'=>$runner_list
								));
    }

    public function editAction(Runner $runner)
    {

		$formBuilder = $this->createFormBuilder($runner);
 		$formBuilder
			->add('lastName',        'text')
			->add('firstName', 'text')
			->add('code', 'text');

 
	  	$form = $formBuilder->getForm();
		$em = $this->getDoctrine()->getManager();

		$request = $this->get('request');

		$value =  $request->query->get('delete'); 
	    if (isset($value)) {
	    	$em->remove($runner);
			$em->flush();
		    return $this->redirect($this->generateUrl('tms_runner_listAll'));
	        }

		if ($request->getMethod() == 'POST' ) {

	        $form->bind($request);

			if ($form->isValid()) {

				$em->persist($runner);
				$em->flush();
		    }
	    }
		$repository = $this->getDoctrine()
			->getManager()
			->getRepository('TmsRunnerBundle:Runner');




		return $this->render('TmsRunnerBundle:Default:edit.html.twig',
					array(		'form' 	=> $form->createView(),
								'runner'=> $runner,
							));

    }

}
