<?php

namespace Wlm\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Wlm\ClientBundle\Entity\Client;
use Wlm\ClientBundle\Form\ClientType;

use Wlm\EquipmentBundle\Entity\Equipment;

class ClientController extends Controller
{
    public function indexAction()
    {

		$request = $this->get('request');
		$repository = $this->getDoctrine()
			->getManager()
			->getRepository('WlmClientBundle:Client');

	    $value =  $request->query->get('searchField'); 
	    if (isset($value)) {
	    	$clients = $repository->getSearchList($value);
	        }
	    else{
			$clients = $repository->findAll();
	    }
		return $this->render('WlmClientBundle::index.html.twig', array(
		      'clients'=>$clients
		    ));
    }

    public function addClientAction()
    {
    		$client = new Client;
    		$form 		= $this->createForm(new ClientType, $client);
    		
    		$request = $this->get('request');
    		$repository = $this->getDoctrine()
    		->getManager()
    		->getRepository('WlmClientBundle:Client');
    	
    	
    		if ($request->getMethod() == 'POST' ) {
    			$request->getMethod();
    			$form->bind($request);
    	
    			if ($form->isValid()) {
    				$em = $this->getDoctrine()->getManager();
    				$em->persist($client);
    				$em->flush();
    				return $this->redirect($this->generateUrl('wlm_client_profile',array('id'=>$client->getId())));
    				
    			}
    		}
    	    	
    		return $this->render('WlmClientBundle::add.html.twig', array(
    				'form' => $form->createView(),
    		));
    	}

    public function profileAction(Client $client)
    {
    	$request = $this->get('request');    	 
    	
    		$list = $request->query->get('list','active');
    	
    	 
	

	return $this->render('WlmClientBundle::profile.html.twig',
						array(		
									'client'=> $client,
									'list' =>$list
									));
    }
    
    public function editAction(Client $client)
    {
    		$form 		= $this->createForm(new ClientType, $client);
    	
    		$request = $this->get('request');
    		$repository = $this->getDoctrine()
    		->getManager()
    		->getRepository('WlmClientBundle:Client');
    	
    	
    		if ($request->getMethod() == 'POST' ) {
    			$request->getMethod();
    			$form->bind($request);
    	
    			if ($form->isValid()) {
    				$em = $this->getDoctrine()->getManager();
    				$em->persist($client);
    				$em->flush();
    				return $this->redirect($this->generateUrl('wlm_client_profile',array('id'=>$client->getId())));
    				
    			}
    		}
    	    	
    		return $this->render('WlmClientBundle::add.html.twig', array(
    				'form' => $form->createView(),
    				'client'=> $client
    		));
    
    

    }
    
    
    
    public function deleteAction(Client $client)
    {
 
    	$em = $this->getDoctrine()->getManager();
    	$em->remove($client);
    	$em->flush();
    
    	return $this->redirect($this->generateUrl('wlm_client_homepage'));
    }

    public function scannerAction(Client $client)
    {

        return $this->render('WlmClientBundle::scanner.html.twig');
    }
    

}
