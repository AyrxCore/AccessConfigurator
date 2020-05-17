<?php

namespace App\Controller\Options;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\ProductSpec;
use App\Entity\Project;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OptionsController extends AbstractController
{
    /**
     * @Route("/internal/{projectId}/options", name="options")
     * @param string $projectId
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function getAllOptions(string $projectId, EntityManagerInterface $em): Response
    {
        $project = $em->getRepository(Project::class)->findOneBy(['id' => $projectId]);
        $houseModel = $project->getHouseModel();
        $houseSurface = $project->getHouseSurface();
        
        $allCategories = $em->getRepository(Category::class)->findAll();
        $allProducts = $em->getRepository(Product::class)->findAll();
        
        $allSpecs = $em->getRepository(ProductSpec::class)->findAll();
        $specsPricesNotNull = array_filter($allSpecs, function(ProductSpec $productSpec) {
            return $productSpec->getPrices() !== null;
        });
        $specsForThisModelAndSurface = array_filter($specsPricesNotNull, function (ProductSpec $specPrices) use ($houseModel, $houseSurface) {
            return array_filter($specPrices->getPrices(), function ($specPrice) use ($houseModel, $houseSurface) {
                    return $specPrice['model'] === $houseModel->getId() && $specPrice['surface'] === $houseSurface->getId();
                }) !== [];
        });
        
        $response = [];
    
        /** @var Category $category */
        foreach ($allCategories as $category) {
            $responseCategory = [];
            $responseCategory['category']['id'] = $category->getId();
            $responseCategory['category']['name'] = $category->getName();
        
            $products = array_filter($allProducts, function(Product $product)use($category) {
                return $product->getCategory()->getId() === $category->getId();
            });
            $responseCategory['products'] = [];
            foreach ($products as $product) {
                foreach ($specsForThisModelAndSurface as $spec) {
                    $responseProduct = [];
                    if($spec->getProduct()->getId() === $product->getId()) {
                        $responseProduct['id'] = $product->getId();
                        $responseProduct['name'] = $product->getName();
                        $responseCategory['products'][] = $responseProduct;
                    }
                }
                $responseCategory['products'] = $this->unique_multidim_array($responseCategory['products'], 'id');
            
                foreach ($specsForThisModelAndSurface as $spec) {
                    $responseSpec = [];
                    if($spec->getProduct()->getId() === $product->getId()) {
                        $responseSpec['id'] = $spec->getId();
                        $responseSpec['type'] = $spec->getType();
                        if($spec->getColor() !== null)
                            $responseSpec['color'] = $spec->getColor();
                        if($spec->getMaterial() !== null)
                            $responseSpec['material'] = $spec->getMaterial();
                        
                        $price = array_values(array_filter($spec->getPrices(), function ($specPrice)use($houseModel, $houseSurface) {
                           return $specPrice['model'] === $houseModel->getId() && $specPrice['surface'] === $houseSurface->getId();
                        }));
                        
                        $responseSpec['price'] = $price[0]['price'];
    
                        $responseCategory['specs'][] = $responseSpec;
                    }
                }
            }
            $response[] = $responseCategory;
        }
        
        // remove Category With Specs Empty
         $response = array_values(array_filter($response, function ($category) {
           return isset($category['specs']);
        }));
        
        return new JsonResponse($response);
    }
    
    public function unique_multidim_array($array, $key) {
        $temp_array = [];
        $i = 0;
        $key_array = [];
    
        foreach($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }
}