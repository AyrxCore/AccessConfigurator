<?php

namespace App\Controller\HouseModel;

use App\Entity\HouseModel;
use App\Entity\Project;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HouseModelController extends AbstractController
{
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
        
        return new JsonResponse();
    }
    
}