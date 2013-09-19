<?php

namespace Ghw\UserBundle\Handler;
 
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
 
class AuthentificationHandler extends ContainerAware implements AuthenticationSuccessHandlerInterface
{
    function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {

            if ($this->container->get('security.context')->isGranted('ROLE_USER')) {
                return new RedirectResponse($this->container->get('router')->generate('ghw_client_homepage'));
            }
            else {

                return new RedirectResponse($this->container->get('router')->generate('ghw_main_homepage'));
            }
            
    }
}

