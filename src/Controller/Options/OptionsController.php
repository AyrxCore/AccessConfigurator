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
        $specsColor = array_filter($specsForThisModelAndSurface, function(ProductSpec $productSpec) {
            return $productSpec->getColor() !== null;
        });
        $specsType = array_filter($specsForThisModelAndSurface, function(ProductSpec $productSpec) {
            return $productSpec->getType() !== null;
        });
        $specsMaterial = array_filter($specsForThisModelAndSurface, function(ProductSpec $productSpec) {
            return $productSpec->getMaterial() !== null;
        });
    
        $responseAllOptions = [];
        
        /** @var Category $category */
        foreach ($allCategories as $category) {
            
            $responseGlobal = [];
            $responseGlobal['name'] = $category->getName();
        
            $products = array_filter($allProducts, function(Product $product)use($category) {
                return $product->getCategory()->getId() === $category->getId();
            });
            
            /** @var Product $product */
            foreach ($products as $product) {
                $oneProduct = [];
                
                $oneProduct['name'] = $product->getName();
                
                $productSpecsColor = array_filter($specsColor, function(ProductSpec $productSpec)use($product) {
                    return $productSpec->getProduct()->getId() === $product->getId();
                });
                
                if($productSpecsColor !== []) {
                    /** @var ProductSpec $color */
                    foreach ($productSpecsColor as $specColor) {
                        $oneColor = [];
                        $oneColor['name'] = $specColor->getColor();
    
                        $price = array_values(array_filter($specColor->getPrices(), function ($specPrice)use($houseModel, $houseSurface) {
                           return $specPrice['model'] === $houseModel->getId() && $specPrice['surface'] === $houseSurface->getId();
                        }));
    
                        $oneColor['price'] = $price[0]['price'];
                        $oneProduct['colors'][$specColor->getId()] = $oneColor;
                    }
                }
    
                $productSpecsType = array_filter($specsType, function(ProductSpec $productSpec)use($product) {
                    return $productSpec->getProduct()->getId() === $product->getId();
                });
                
                if($productSpecsType !== []) {
                    /** @var ProductSpec $color */
                    foreach ($productSpecsType as $specType) {
                        $oneType = [];
                        $oneType['name'] = $specType->getType();
            
                        $price = array_values(array_filter($specType->getPrices(), function ($specPrice)use($houseModel, $houseSurface) {
                            return $specPrice['model'] === $houseModel->getId() && $specPrice['surface'] === $houseSurface->getId();
                        }));
    
                        $oneType['price'] = $price[0]['price'];
                        $oneProduct['types'][$specType->getId()] = $oneType;
                    }
                }
    
                $productSpecsMaterial = array_filter($specsMaterial, function(ProductSpec $productSpec)use($product) {
                    return $productSpec->getProduct()->getId() === $product->getId();
                });
    
                if($productSpecsMaterial !== []) {
                    /** @var ProductSpec $color */
                    foreach ($productSpecsMaterial as $specMaterial) {
                        $oneMaterial = [];
                        $oneMaterial['name'] = $specMaterial->getMaterial();
            
                        $price = array_values(array_filter($specMaterial->getPrices(), function ($specPrice)use($houseModel, $houseSurface) {
                            return $specPrice['model'] === $houseModel->getId() && $specPrice['surface'] === $houseSurface->getId();
                        }));
    
                        $oneMaterial['price'] = $price[0]['price'];
                        $oneProduct['matters'][$specMaterial->getId()] = $oneMaterial;
                    }
                }
                $responseGlobal['products'][$product->getId()] = $oneProduct;
            }
            $responseAllOptions[$category->getId()] = $responseGlobal;
        }
        $responseAllProducts = [];
        
        foreach ($responseAllOptions as $option) {
            foreach ($option['products'] as $productId => $product) {
                $responseAllProducts[$productId] = $product;
            }
        }
        
        return new JsonResponse([
            'allOptions' => $responseAllOptions,
            'allProducts' => $responseAllProducts
        ]);
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