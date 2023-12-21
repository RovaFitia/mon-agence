<?php

namespace App\Controller ;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError() ;
        $lastUser = $authenticationUtils->getLastUsername() ;

        dump($lastUser) ;

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUser,
            'error' => $error
        ]) ;
    }
}