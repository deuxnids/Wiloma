<?php

namespace Wlm\FacturationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Wlm\ClientBundle\Entity\Client;
use Wlm\ClientBundle\Entity\Location;
use Wlm\TillBundle\Entity\Till;

use Doctrine\Common\Collections\ArrayCollection;


class FacturationController extends Controller
{
    public function facturationAction(Client $client)
    {
		$amount = 0;
		$repository = $this->getDoctrine()
	       ->getManager()
	       ->getRepository('WlmOperationBundle:Rent');
		$activeRents = new ArrayCollection();
				$rents = $repository->findByClient($client);
		foreach ($rents as $rent ) {			
			if($rent->getAmountDue()!=0 )
			{
				$amount = $amount + $rent->getAmountDue();
		
				$activeRents->add($rent);
			}
		}
		

		
        return $this->render('WlmFacturationBundle::facturation.html.twig', array(
		      'amount' => $amount,
		      'rents' => $activeRents
		    ));
    }
}
