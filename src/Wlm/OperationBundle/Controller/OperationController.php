<?php

namespace Wlm\OperationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Wlm\ClientBundle\Entity\Client;
use Wlm\OperationBundle\Entity\Operation;
use Wlm\OperationBundle\Entity\Rents;
use Wlm\OperationBundle\Entity\Rent;

use Wlm\EquipmentBundle\Entity\Equipment;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Wlm\OperationBundle\Form\OperationType;
use Wlm\OperationBundle\Form\RentsType;
use Wlm\OperationBundle\Form\RentType;


use Doctrine\Common\Collections\ArrayCollection;


use Symfony\Component\Validator\Constraints\Date;

class OperationController extends Controller
{
	
	public function indexAction()
	{
	
		$request = $this->get('request');
		$repository = $this->getDoctrine()
		->getManager()
		->getRepository('WlmOperationBundle:Rent');
	
		$value =  $request->query->get('searchField');
		if (isset($value)) {
			$rents = $repository->getSearchList($value);
		}
		else{
			$rents = $repository->findAll();
		}
		return $this->render('WlmOperationBundle:Rent:index.html.twig', array(
				'rents'=>$rents
		));
	}
	
	
	
    public function addAction(Client $client)
    {
	    $em 			= $this->getDoctrine()->getManager();
	    $request 		= $this->get('request');
	    
    	$rents		 	= new Rents;
		$form 			= $this->createForm(new RentsType, $rents);
		
		if ($request->isMethod('POST') ) {
			$form->bind($request);
			if ($form->isValid()){
			$i		=0;
	        
			foreach ($rents->getRents() as $rent) {
		        $code = $request->request->get('wlm_operationbundle__operationstype[rents]['.$i.'][code]',null,true);
				$i = $i + 1;		
			 	$rent->setClient($client);
				$repository2 = $this->getDoctrine()
	       									->getManager()
	       									->getRepository('WlmEquipmentBundle:Equipment');
	       		$equipment = new Equipment;
				$equipment = $repository2->findOneByCode($code);
				$rent->setEquipment($equipment);
				$equipment->setStatus('out');
		      	$em->persist($rent);
			}
        		
			$em->flush();
			
     	    return $this->redirect($this->generateUrl('wlm_client_profile',array('id'=>$client->getId())));   	
		}

		}
		
		
        return $this->render('WlmOperationBundle:Rent:add.html.twig', array(
		      'form' => $form->createView(),
        	  'client'=> $client
		    ));
		    
		    
    }

    public function editAction(Rent $rent)
    {   
        $em 			= $this->getDoctrine()->getManager(); 
        $client 		= $rent->getClient();
                
        $form 			= $this->createForm( new RentType, $rent );
        $form->get('code')->setData($rent->getEquipment()->getCode());
        
        $request 		= $this->get('request');
        
        if ( $request->isMethod('POST') ) {
        	$form->bind($request);
        	if ( $form->isValid()){
        		 
        			$code = $request->request->get('wlm_Operationbundle_Operationtype[code]',null,true);
        			$rent->setClient($client);
        			$repository2 = $this->getDoctrine()
        				->getManager()
        				->getRepository('WlmEquipmentBundle:Equipment');
        			$rent->getEquipment()->setStatus('in');
        			$equipment = $repository2->findOneByCode($code);
        			$equipment->setStatus('out');
        			 
        			$rent->setEquipment($equipment);
        			$em->persist($rent);

        		$em->flush();	
        		return $this->redirect($this->generateUrl('wlm_client_profile',array('id'=>$client->getId())));
        	}

        }
        
        return $this->render('WlmOperationBundle:Rent:edit.html.twig', array(
        		'form' => $form->createView(),
        		'client'=> $client,
        ));   
    }

	public function getActiveAction(Client $client)
	{
		$repository = $this->getDoctrine()
			->getManager()
			->getRepository('WlmOperationBundle:Rent');
		
		$rents = $repository->findByClient($client);
		$activeRents = new ArrayCollection();
		
		foreach ($rents as $rent)
		{
			if($rent->getAmountDue()!=0 || $rent->getEquipment()->getStatus()=="out")
			{
				$activeRents->add($rent);
			}
		}
		
		return $this->render('WlmOperationBundle:Rent:list.html.twig', array(
				'rents'=> $activeRents,
		));
	}
	
	
	public function getAllAction(Client $client)
	{
				
		$repository = $this->getDoctrine()
			->getManager()
			->getRepository('WlmOperationBundle:Rent');
	
		$rents = $repository->findByClient($client);
		return $this->render('WlmOperationBundle:Rent:list.html.twig', array(
				'rents'=> $rents,
		));
	}
    
	public function deleteAction(Operation $operation)
	{
		$em = $this->getDoctrine()->getManager();
		$em->remove($operation);
		$em->flush();
	
		return $this->redirect($this->generateUrl('wlm_rents'));
	}
	
	public function createPdfAction(Client $client)
	{
		
		
		$pdf = $this->get("white_october.tcpdf")->create();
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Wiloma');
		$pdf->SetTitle('Facturation');
		$pdf->SetSubject('Facturation');
		$pdf->SetKeywords('Facturation');
		
		// set default header data
		$pdf->SetHeaderData('symfony_logo.png', PDF_HEADER_LOGO_WIDTH, '', '', array(0,0,0), array(0,0,0));
		$pdf->setFooterData(array(0,0,0), array(0,0,0));
		
		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		
		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		
		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		
		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		
		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$pdf->setLanguageArray($l);
		}
		
		// ---------------------------------------------------------
		
		// set default font subsetting mode
		$pdf->setFontSubsetting(true);
		
		// Set font
		// dejavusans is a UTF-8 Unicode font, if you only need to
		// print standard ASCII chars, you can use core fonts like
		// helvetica or times to reduce file size.
		$pdf->SetFont('dejavusans', '', 12, '', true);
		
		// Add a page
		// This method has several options, check the source code documentation for more information.
		$pdf->AddPage();
		
		// set text shadow effect
		$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
		
		// Set some content to print
		
		
		
		$html = $this->renderView('WlmOperationBundle:Pdf:pdf.html.twig');
		
		// Print text using writeHTMLCell()
		$pdf->writeHTMLCell(0, 0, '', '', $html, 10, 1, 0, true, '', true);
		
		// ---------------------------------------------------------
		
		// Close and output PDF document
		// This method has several options, check the source code documentation for more information.
		
		$response = new Response($pdf->Output('example_001.pdf'));
		$response->headers->set('Content-Type', 'application/pdf');
		
		return $response;		
		
	}
	
	/**
	 * @Route("/Operation/{clientId}/{id}")
	 * @ParamConverter("client", class="WlmClientBundle:Client", options={"id" = "clientId"})
	 */
    /*
    public function addAction(Client $client, Material $material )
    {
    	$Operation = new Operation;
    	$Operation->setClient($client);
    	$Operation->setMaterial($material);
    	$Operation->setInDate(new \DateTime());
    	$Operation->setOutDate(new \DateTime());
    	 
    	$em = $this->getDoctrine()->getManager();
    	
    	//ne pas faire comme ca :), c est debile
    	$Operation->setBarcode($material->getBarCode());
    	
    	$em->persist($Operation);
    	$em->flush();
    	
    	return new Response('true' );
    	 
    }
    
    private function persistOperationBucketForm(Request $request)
    {
    	
    }

*/


}
