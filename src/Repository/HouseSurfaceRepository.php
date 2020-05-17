<?php

namespace App\Repository;

use App\Entity\HouseSurface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HouseSurface|null find($id, $lockMode = null, $lockVersion = null)
 * @method HouseSurface|null findOneBy(array $criteria, array $orderBy = null)
 * @method HouseSurface[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HouseSurfaceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HouseSurface::class);
    }
    
    public function findAll()
    {
        return $this->findBy(array(), array('surface' => 'ASC'));
    }
}
