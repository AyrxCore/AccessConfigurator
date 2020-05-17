<?php

namespace App\Repository;

use App\Entity\ProductSpec;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProductSpec|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductSpec|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductSpec[]    findAll()
 * @method ProductSpec[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductSpecRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductSpec::class);
    }
}


