<?php

namespace App\Controller\HouseSurface;

use App\Entity\HouseModel;
use App\Entity\HouseSurface;
use App\Entity\Project;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HouseSurfaceController
{
    /**
     * @Route("/internal/{projectId}/surfaces", name="surfaces")
     * @param string $projectId
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function getAllSurfaces(string $projectId, EntityManagerInterface $em): Response
    {
        $project = $em->getRepository(Project::class)->findOneBy(['id' => $projectId]);
        $houseModelId = $project->getHouseModel()->getId();
        $surfaces = $em->getRepository(HouseSurface::class)->findBy(['houseModel' => $houseModelId]);
        
        $response = [];
        
        if($surfaces !== []) {
            $responseSurface = [];
            
            foreach ($surfaces as $surface) {
                $responseSurface['id'] = $surface->getId();
                $responseSurface['surface'] = $surface->getSurface();
                $responseSurface['imgRdc'] = $surface->getImgRdc();
                $responseSurface['imgFloor'] = $surface->getImgFloor();
                $responseSurface['description'] = $surface->getDescription();
                $responseSurface['lowerPrice'] = $surface->getLowerPrice();
                
                $response[] = $responseSurface;
            }
        }
        
        return new JsonResponse($response);
    }
    
    /**
     * @Route("/internal/{projectId}/chosen_surface", name="chosen_surface")
     * @param string $projectId
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return Response
     */
    public function saveChosenSurface(string $projectId, EntityManagerInterface $em, Request $request): Response
    {
        $project = $em->getRepository(Project::class)->findOneBy(['id' => $projectId]);
        $chosenSurface = json_decode($request->getContent(), true);
        
        $houseSurface = $em->getRepository(HouseSurface::class)->findOneBy(['id' => $chosenSurface['id']]);
        
        $project->setHouseSurface($houseSurface);
        $project->setLowerPrice($houseSurface->getLowerPrice());
        
        $em->persist($project);
        $em->flush();
        
        return new JsonResponse();
    }
}