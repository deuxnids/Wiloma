<?php

namespace Wlm\TillBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Wlm\OperationBundle\Entity\Operation;
use Wlm\TillBundle\Entity\Till;

use Symfony\Component\HttpFoundation\Response;

use SaadTazi\GChartBundle\DataTable;


class TillController extends Controller
{
	public function indexAction()
	{
		
		$request = $this->get('request');
		$repository = $this->getDoctrine()
		->getManager()
		->getRepository('WlmTillBundle:Till');
	
		$value =  $request->query->get('searchField');
		if (isset($value)) {
			$tills = $repository->getSearchList($value);
		}
		else{
			$tills = $repository->findAll();
		}

		
		$dataTable2 = new DataTable\DataTable();
		$dataTable2->addColumn('id1', 'label 1', 'datetime');
		$dataTable2->addColumnObject(new DataTable\DataColumn('id2', 'location', 'number'));
		$dataTable2->addColumnObject(new DataTable\DataColumn('id3', 'vente', 'number'));
		foreach ($tills as $till)
		{
			$dataTable2->addRow(array($till->getDate(), $till->getAmount() ));	
		}

		return $this->render('WlmTillBundle:Till:index.html.twig', array(
				'tills'=>$tills,
				'dataTable2' => $dataTable2->toArray()
		));
	}
	
	public function deleteAction(Till $till)
	{
    	$em = $this->getDoctrine()->getManager();
    	$em->remove($till);
    	$em->flush();
    
    	return $this->redirect($this->generateUrl('wlm_till'));
	}	

    
    
    public function payAction(Operation $operation)
    {
    	
    	$amount = $operation->getAmountDue();

    	$till = new Till();
		$till->setDate(new \DateTime());
		$till->setAmount($amount);
		$till->setMode('cash');
		$operation->addTill($till);		
		
		
    	$em = $this->getDoctrine()->getManager();
    	$em->persist($till);
    	$em->persist($operation);
    	 
    	$em->flush();
    	
		return new Response('true' );
    	    		
    	
    }
}
