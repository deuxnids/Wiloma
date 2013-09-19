<?php

namespace Wlm\EquipmentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Wlm\EquipmentBundle\Entity\Master;
use Wlm\EquipmentBundle\Entity\Equipment;
use Wlm\EquipmentBundle\Form\EquipmentType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class EquipmentController extends Controller
{
    public function indexAction()
    {
		$request = $this->get('request');
		$repository = $this->getDoctrine()
			->getManager()
			->getRepository('WlmEquipmentBundle:Equipment');

	    $value =  $request->query->get('searchField'); 
	    if (isset($value)) {
	    		$equipments = $repository->getSearchList($value);
	    }
	    else{
				$equipments = $repository->findAll();
	    }
		    return $this->render('WlmEquipmentBundle:Equipment:index.html.twig', array(
		      'equipments'=>$equipments
		    ));
    	}


    public function profileAction(Equipment $equipment)
    {

  
    	$repository = $this->getDoctrine()
    		->getManager()
    		->getRepository('WlmOperationBundle:Rent');
    	$rents = $repository->findByEquipment($equipment);
    	
	return $this->render('WlmEquipmentBundle:Equipment:profile.html.twig',
						array(		
									'equipment'=> $equipment,
									'rents'=>$rents
								));
    }

    public function addAction(Master $master)
    {
		$equipment 	= new Equipment;
		$equipment->setMaster($master);			
		$form 		= $this->createForm(new EquipmentType, $equipment);
		$request 	= $this->get('request');

		if ($request->getMethod() == 'POST' ) {
	        $form->bind($request);
			if ($form->isValid()) {
				$em = $this->getDoctrine()->getManager();
				$em->persist($equipment);
				$em->flush();
				return $this->redirect($this->generateUrl('wlm_equipment_equipmentProfile',array('id'=> $equipment->getId())));
		    }
	    }
		$repository = $this->getDoctrine()
			->getManager()
			->getRepository('WlmEquipmentBundle:Master');
		$master = $repository->find($master->getId()); 

    	return $this->render('WlmEquipmentBundle:Equipment:add.html.twig',
						array(		'form' 	=> $form->createView(),
									'master'=> $master
								));
    }
    

    public function editAction(Equipment $equipment)
    {
    	$em = $this->getDoctrine()->getManager();
    	$form = $this->createForm(new EquipmentType, $equipment );
    	$request = $this->get('request');
    
    	if ($request->getMethod() == 'POST' ) {
    		$form->bind($request);
    		$em->persist($equipment);
    		$em->flush();
    		return $this->redirect($this->generateUrl('wlm_equipment_equipmentProfile',array('id'=> $equipment->getId())));
    	}
    
    	return $this->render('WlmEquipmentBundle:Equipment:edit.html.twig', array(
    			'form' 		=> $form->createView(),
    			'equipment' 	=> $equipment
    	));
    }
    
    
    public function deleteAction(Equipment $equipment)
    {
    	$repository = $this->getDoctrine()
    	->getManager()
    	->getRepository('WlmEquipmentBundle:Equipment');
    	$em = $this->getDoctrine()->getManager();
    	$em->remove($equipment);
    	$em->flush();
    	 
    	return $this->redirect($this->generateUrl('wlm_equipment'));
    }
    
    
    
    public function setInAction(Equipment $equipment)
    {
    	$equipment->setStatus("in");
    
    	$em = $this->getDoctrine()->getManager();
    	$em->persist($equipment);
    	$em->flush();
    
    	return new Response('true' );
    }
    
    
    public function setOutAction(Equipment $equipment)
    {
    	$equipment->setStatus("out");
    
    	$em = $this->getDoctrine()->getManager();
    	$em->persist($equipment);
    	$em->flush();
    
    	return new Response('true' );
    }
    
    
    
    
}
