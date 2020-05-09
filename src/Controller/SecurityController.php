<?php

namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login", methods={"POST"})
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function __invoke(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        
        return $this->render('app.html.twig', [
            'last_username' => $lastUsername,
            'is_authenticated' => json_encode(!empty($this->getUser())),
            'error' => $error
        ]);
    }
    
    /**
     * @Route("/logout", name="logout", methods={"GET"})
     *
     * @throws Exception
     */
    public function logout()
    {
        // controller can be blank: it will never be executed!
        throw new Exception('Don\'t forget to activate logout in security.yaml');
    }
    
}
