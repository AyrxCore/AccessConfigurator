<?php

namespace App\Controller\Project;

use App\Entity\Project;
use App\Entity\User;
use App\Enum\AllApiRoutes;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    /**
     * @Route("/internal/{userId}/projects", name="list_projects")
     * @param string $userId
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function getAllProjects(string $userId, EntityManagerInterface $em): Response
    {
        $projects = $em->getRepository(Project::class)->findBy(['user' => $userId]);
        
        $response = [];
        
        if($projects !== []) {
            $responseProject = [];
            
            foreach ($projects as $project) {
                $responseProject['id'] = $project->getId();
                $responseProject['project_name'] = $project->getName();
                $responseProject['date'] = $project->getCreated()->format('d-m-Y');
                $responseProject['client_name'] = $project->getClientName();
                $responseProject['client_address'] = $project->getClientAddress();
                $responseProject['model'] = $project->getHouseModel() === null ? "Non sélectionné" : $project->getHouseModel()->getName();
                $responseProject['surface'] = $project->getHouseSurface() === null ? "Non sélectionnée" : $project->getHouseSurface()->getSurface();
                
                $response[] = $responseProject;
            }
        }
        return new JsonResponse($response);
    }
    
    /**
     * @Route("/internal/{userId}/new_project", name="new_project")
     * @param string $userId
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function createNewProject(string $userId, EntityManagerInterface $em, Request $request): Response
    {
        $user = $em->getRepository(User::class)->findOneBy(['id' => $userId]);
        $data = json_decode($request->getContent(), true);
        
        $newProject = new Project();
        $newProject->setName($data['projectName']);
        $newProject->setClientName($data['clientName']);
        $newProject->setClientAddress($data['clientAddress']);
        
        if($user instanceof User)
            $user->addProject($newProject);
        else
            throw new Exception("this user ID does not exist");
        
        $em->persist($user);
        $em->persist($newProject);
        $em->flush();
        
        return new JsonResponse($newProject->getId());
    }
    
    /**
     * @Route("/internal/{projectId}/edit_project", name="edit_project")
     * @param string $projectId
     * @param EntityManagerInterface $em
     * @return Response
     * @throws Exception
     */
    public function editProject(string $projectId, EntityManagerInterface $em): Response
    {
        $project = $em->getRepository(Project::class)->findOneBy(['id' => $projectId]);
        
        if(!($project instanceof Project)) {
            throw new Exception("this project ID does not exist");
        }
        
        if($project->getHouseModel() === null) {
            $response = AllApiRoutes::MODEL_STEP;
        }
        else if($project->getHouseSurface() === null) {
            $response = AllApiRoutes::SURFACE_STEP;
        }
        else if($project->isFullyConfiguredOptions() === false) {
            $response = AllApiRoutes::OPTIONS_STEP;
        }
        else {
            $response = AllApiRoutes::SUMMARY_STEP;
        }
        return new JsonResponse($response);
    }
    
    /**
     * @Route("/internal/{userId}/{projectId}/delete_project", name="delete_project")
     * @param string $userId
     * @param string $projectId
     * @param EntityManagerInterface $em
     * @return Response
     * @throws Exception
     */
    public function deleteProject(string $userId, string $projectId, EntityManagerInterface $em): Response
    {
        $user = $em->getRepository(User::class)->findOneBy(['id' => $userId]);
        $project = $em->getRepository(Project::class)->findOneBy(['id' => $projectId]);
        
        if(!($project instanceof Project)) {
            throw new Exception("this project ID does not exist");
        }
        
        $user->removeProject($project);
        
        $em->remove($project);
        $em->persist($user);
        $em->flush();
        
        return new JsonResponse();
    }
}