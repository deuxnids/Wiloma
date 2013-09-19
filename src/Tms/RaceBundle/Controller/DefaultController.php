<?php

namespace Tms\RaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Tms\RunnerBundle\Entity\Runner;
use Tms\RaceBundle\Entity\Arrivals;
use Symfony\Component\HttpFoundation\Response;




class DefaultController extends Controller
{
    public function indexAction()
    {		

        return $this->render('TmsRaceBundle:Default:index.html.twig');			
    }


    public function stopAction()
    {		
	    $request = $this->container->get('request');
        $scannedCode = $request->query->get('scan');
        if(isset($scannedCode)){
        	$this->setCodeOrderByTime($scannedCode);
        	$request->query->set('');
        }

		$arrival_list = $this->getArrivalList();
		$url = "http://192.168.1.101/Symfony/web/app.php/tms/race/stop?scan={CODE}";
		$url = urlencode($url);
        return $this->render('TmsRaceBundle:Default:stopTimer.html.twig',array('arrival_list' => $arrival_list, 'encodedUrl'=>$url));
    }

    public function mobileAction()
    {		


        return $this->render('TmsRaceBundle:Default:mobile.html.twig');
    }

    public function saveStartTimeAction()
    {		

	    $request = $this->container->get('request');
	    if($request->isXmlHttpRequest())
	    {
	        $motcle = $request->request->get('start');

	        $em = $this->container->get('doctrine')->getEntityManager();

	        if($motcle != '')
	        {
			$repository = $this->getDoctrine()
				->getManager()
				->getRepository('TmsRunnerBundle:Runner');

	    	$runner_list = $repository->findAll();
			$em = $this->getDoctrine()->getManager();

	    	foreach ($runner_list as $runner) {
	    		$runner->setTimeStart($motcle);
				$em->persist($runner);
			}	
			$em->flush();

	        }


	    }
	     return new Response("<div> Start Time saved into database assigned to all runner : " .$motcle."</div>");
    }


    public function saveStopTimeAction()
    {		

	    $request = $this->container->get('request');
	    if($request->isXmlHttpRequest())
	    {
	        $motcle = '';
	        $motcle = $request->request->get('stop');

	        $em = $this->container->get('doctrine')->getEntityManager();

	        if($motcle != '')
	        {
				$repository = $this->getDoctrine()
					->getManager()
					->getRepository('TmsRaceBundle:Arrivals');

				$arrival = new Arrivals;
				$arrival->setTimeStop($motcle);

				$em = $this->getDoctrine()->getManager();

					$em->persist($arrival);
				
				$em->flush();
				$arrival_list = $repository->findAllOrderedByArrivalTime();
	        }

	    }
	    $content = $this->renderView('TmsRaceBundle:Default:listArrivals.html.twig',
    			array('arrival_list' => $arrival_list)
				);
	    $response = new Response();
	    $response->setContent($content);
	    $response->headers->set('Content-Type', 'text/html');


		return $response;
    }

    public function deleteStopTimeAction()
    {		

	    $request = $this->container->get('request');
	    if($request->isXmlHttpRequest())
	    {
	        $motcle = '';
	        $motcle = $request->request->get('deleteId');

	        $em = $this->container->get('doctrine')->getEntityManager();

	        if($motcle != '')
	        {
				$repository = $this->getDoctrine()
					->getManager()
					->getRepository('TmsRaceBundle:Arrivals');

			    	$arrival = $repository->findOneById($motcle);
			    	$em->remove($arrival);
					$em->flush();
					$arrival_list = $this->getArrivalList();

	        }

	    }

	    $content = $this->renderView('TmsRaceBundle:Default:listArrivals.html.twig',
    			array('arrival_list' => $arrival_list)
				);
	    $response = new Response();
	    $response->setContent($content);
	    $response->headers->set('Content-Type', 'text/html');


		return $response;
    }




    private function getArrivalList() {

		$repository = $this->getDoctrine()
					->getManager()
					->getRepository('TmsRaceBundle:Arrivals');

		return		$repository->findAllOrderedByArrivalTime();
    }

    private function setCodeOrderByTime($code) {
    	$repository = $this->getDoctrine()
					->getManager()
					->getRepository('TmsRaceBundle:Arrivals');
		$arrival = $repository->findLatestArrivalTime();
		$arrival->setCode($code);
        $em = $this->container->get('doctrine')->getEntityManager();
		$em->flush();



		return		true;
    }


}
