<?php

namespace Wlm\ScannerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Wlm\ClientBundle\Entity\Client;
use Symfony\Component\HttpFoundation\Response;


class ScannerController extends Controller
{
    public function scannerAction(Client $client)
    {
    	$url ="http://zxing.appspot.com/scan?ret=";
   		//$url2= $this->generateUrl('wlm_scanner_url',array('id'=> $client->getId() ));
    	$url2= "http://test.de/";
    	$url2 .= $client->getId();
    	$url2.= "/{CODE}";
    	$url .= urlencode($url2);
        return $this->render('WlmScannerBundle::scanner.html.twig', array(
		      'url' 	=> $url,
        	  'url2' => $url2	
		    ));
    }
    
    public function createUrlAction(Client $client)
    {
    	 return new Response('true' );
    }
}
