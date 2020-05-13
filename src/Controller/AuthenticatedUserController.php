<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/authenticated-user", name="authenticated_user")
 */
final class AuthenticatedUserController extends AbstractController
{
    public function __invoke(SerializerInterface $serializer)
    {
        /** @var User $user */
        $user = $this->getUser();
        $userResponse['connected'] = false;
        
        if($user) {
            $userResponse['id'] = $user->getId();
            $userResponse['connected'] = true;
            $userResponse['firstname'] = $user->getFirstname();
            $userResponse['lastname'] = $user->getLastname();
            $userResponse['email'] = $user->getEmail();
        }
        
        return new Response($serializer->serialize($userResponse, 'json'));
    }
}