<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new JMS\AopBundle\JMSAopBundle(),
            new JMS\DiExtraBundle\JMSDiExtraBundle($this),
            new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new Ghw\UserBundle\GhwUserBundle(),
            new Ghw\MainBundle\GhwMainBundle(),
            new Ghw\ClientBundle\GhwClientBundle(),
            new Ghw\WriterBundle\GhwWriterBundle(),
            new Ghw\MatchBundle\GhwMatchBundle(),
            new Wlm\ClientBundle\WlmClientBundle(),
            new Wlm\EquipmentBundle\WlmEquipmentBundle(),
            new Wlm\OperationBundle\WlmOperationBundle(),
            new Tms\RunnerBundle\TmsRunnerBundle(),
            new Tms\RaceBundle\TmsRaceBundle(),
            new Wlm\FacturationBundle\WlmFacturationBundle(),
            new Wlm\TillBundle\WlmTillBundle(),
            new Wlm\ScannerBundle\WlmScannerBundle(),
        		new WhiteOctober\TCPDFBundle\WhiteOctoberTCPDFBundle(),
        		new SaadTazi\GChartBundle\SaadTaziGChartBundle(),
        		
        		
        	
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }


}
