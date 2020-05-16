<?php

namespace App\Controller;

use App\Entity\HouseModel;
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
        
        $response = [];
        
        if($projects !== []) {
            $responseProject = [];
    
            foreach ($projects as $project) {
                $responseProject['id'] = $project->getId();
                $responseProject['name'] = $project->getName();
                $responseProject['date'] = $project->getCreated()->format('d-m-Y');
                $responseProject['client_name'] = $project->getClientName();
                $responseProject['client_address'] = $project->getClientAddress();
                $responseProject['model'] = $project->getHouseModel() === null ? "Non sélectionné" : $project->getHouseModel()->getName();
                $responseProject['surface'] = $project->getHouseSize() === null ? "Non sélectionnée" : $project->getHouseSize()->getSurface();
        
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
        
        $response = $newProject->getId();
        
        return new JsonResponse($response);
    }
    
    /**
     * @Route("/internal/{projectId}/edit_project", name="edit_project")
     * @param string $projectId
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function editProject(string $projectId, EntityManagerInterface $em, Request $request): Response
    {
        $project = $em->getRepository(Project::class)->findOneBy(['id' => $projectId]);
        
        if(!($project instanceof Project)) {
            throw new Exception("this project ID does not exist");
        }
    
        if($project->getHouseModel() === null) {
            $response = AllApiRoutes::MODEL_STEP;
        }
        else if($project->getHouseSize() === null) {
            $response = AllApiRoutes::SIZE_STEP;
        }
        else if($project->getFullyConfiguredOptions() === false) {
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
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function deleteProject(string $userId, string $projectId, EntityManagerInterface $em, Request $request): Response
    {
        dump($userId);
        dump($projectId);
        
        $user = $em->getRepository(User::class)->findOneBy(['id' => $userId]);
        $project = $em->getRepository(Project::class)->findOneBy(['id' => $projectId]);
        
        if(!($project instanceof Project)) {
            throw new Exception("this project ID does not exist");
        }
        
        $user->removeProject($project);
        
        $em->persist($user);
        $em->persist($project);
        $em->flush();
        
        $response = true;
        
        return new JsonResponse($response);
    }
    
    /**
     * @Route("/internal/models", name="models")
     * @param EntityManagerInterface $em
     * @return Response
     * @throws Exception
     */
    public function getAllModels(EntityManagerInterface $em): Response
    {
        $models = $em->getRepository(HouseModel::class)->findAll();
    
        $response = [];
    
        if($models !== []) {
            $responseModel = [];
        
            foreach ($models as $model) {
                $responseModel['id'] = $model->getId();
                $responseModel['name'] = $model->getName();
                $responseModel['img'] = $model->getImg();
                $responseModel['description'] = $model->getDescription();
                $responseModel['lowerPrice'] = $model->getLowerPrice();
            
                $response[] = $responseModel;
            }
        }
        
        return new JsonResponse($response);
    }
    
    /**
     * @Route("/internal/{projectId}/chosen_model", name="chosen_model")
     * @param string $projectId
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return Response
     */
    public function saveChosenModel(string $projectId, EntityManagerInterface $em, Request $request): Response
    {
        $project = $em->getRepository(Project::class)->findOneBy(['id' => $projectId]);
        $chosenModel = json_decode($request->getContent(), true);
    
        $houseModel = $em->getRepository(HouseModel::class)->findOneBy(['id' => $chosenModel['id']]);
        
        $project->setHouseModel($houseModel);
        
        $em->persist($project);
        $em->flush();
        
        $response = true;
        return new JsonResponse($response);
    }
}
