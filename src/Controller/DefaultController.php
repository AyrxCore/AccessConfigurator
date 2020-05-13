<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function index(AuthenticationUtils $authenticationUtils): Response
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
     * @Route("/internal/{userId}/projects", name="list_projects")
     * @param string $userId
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function getAllProjects(string $userId, EntityManagerInterface $em): Response
    {
        $projects = $em->getRepository(Project::class)->findBy(['user' => $userId]);
        $responseProject = [];
        $response = [];
        
        foreach ($projects as $project) {
            $responseProject['id'] = $project->getId();
            $responseProject['name'] = $project->getName();
            $responseProject['date'] = $project->getCreated()->format('d-m-Y');
            $responseProject['client_name'] = $project->getClientName();
            $responseProject['client_address'] = $project->getClientAddress();
            $responseProject['model'] = $project->getHouseModel()->getName();
            $responseProject['surface'] = $project->getHouseSize()->getSurface();
            
            $response[] = $responseProject;
        }
        return new JsonResponse($response);
    }
    
    /**
     * @Route("/internal/{userId}/newproject", name="new_project")
     * @param string $userId
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return Response
     */
    public function createNewProject(string $userId, EntityManagerInterface $em, Request $request): Response
    {
        $user = $em->getRepository(User::class)->findBy(['id' => $userId]);
        dump($request->getContent());
        $project = new Project();
//        $project->setClientName()
//        $responseProject = [];
        $response = [];
        
//        foreach ($projects as $project) {
//            $responseProject['id'] = $project->getId();
//            $responseProject['name'] = $project->getName();
//            $responseProject['date'] = $project->getCreated()->format('d-m-Y');
//            $responseProject['client_name'] = $project->getClientName();
//            $responseProject['client_address'] = $project->getClientAddress();
//            $responseProject['model'] = $project->getHouseModel()->getName();
//            $responseProject['surface'] = $project->getHouseSize()->getSurface();
//
//            $response[] = $responseProject;
//        }
        return new JsonResponse($response);
    }
}
