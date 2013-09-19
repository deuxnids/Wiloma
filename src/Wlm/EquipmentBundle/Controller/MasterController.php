<?php

namespace Wlm\EquipmentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Wlm\EquipmentBundle\Entity\Master;
use Wlm\EquipmentBundle\Form\MasterType;

class MasterController extends Controller
{
    public function indexAction()
    {
		$request 	= 	$this->get('request');	
		$repository = $this->getDoctrine()
			->getManager()
			->getRepository('WlmEquipmentBundle:Master');

	    $value =  $request->query->get('searchField'); 
	    if (isset($value)) {
	    		$masters = $repository->getSearchList($value);
	    }
	    else{
				$masters = $repository->findAll();
	    }

		    return $this->render('WlmEquipmentBundle:Master:index.html.twig', array(
		      'masters'=>$masters
		    ));
    	}


    public function profileAction(Master $master)
    {


	return $this->render('WlmEquipmentBundle:Master:profile.html.twig',
						array(	'master'=> $master));
    }

    public function editAction(Master $master)
    {
    	$em = $this->getDoctrine()->getManager();
    	$form = $this->createForm(new MasterType, $master );
    	$request = $this->get('request');
    
    	if ($request->getMethod() == 'POST' ) {
    		$form->bind($request);
    		$em->persist($master);
    		$em->flush();
    		return $this->redirect($this->generateUrl('wlm_equipment_masterProfile',array('id'=> $master->getId())));
    	}
    
    	return $this->render('WlmEquipmentBundle:Master:edit.html.twig', array(
    			'form' 		=> $form->createView(),
    			'master' 	=> $master
    	));
    }
    
    public function addAction()
    {
    	$master = new Master;
		$form = $this->createForm(new MasterType, $master);

		$request = $this->get('request');
		$repository = $this->getDoctrine()
			->getManager()
			->getRepository('WlmEquipmentBundle:Master');

		if ($request->getMethod() == 'POST' ) {
			$request->getMethod(); 
	        $form->bind($request);

			if ($form->isValid()) {
				$em = $this->getDoctrine()->getManager();
				$em->persist($master);
				$em->flush();
		      	}
		      	
		      	return $this->render('WlmEquipmentBundle:Master:profile.html.twig',
		      			array(		'master' 	=> $master
		      			));
	        }

    	return $this->render('WlmEquipmentBundle:Master:add.html.twig',
    			array(		'form' 	=> $form->createView()
    			));
    	
    	
    }
    
    public function deleteAction(Master $master)
    {
    	$repository = $this->getDoctrine()
    		->getManager()
    		->getRepository('WlmEquipmentBundle:Master');
    	$em = $this->getDoctrine()->getManager();
    	$em->remove($master);
    	$em->flush();
    	
    	return $this->redirect($this->generateUrl('wlm_equipment_master'));
    }

}
