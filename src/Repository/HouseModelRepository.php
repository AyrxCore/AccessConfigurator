<?php

namespace App\Repository;

use App\Entity\HouseModel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HouseModel|null find($id, $lockMode = null, $lockVersion = null)
 * @method HouseModel|null findOneBy(array $criteria, array $orderBy = null)
 * @method HouseModel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HouseModelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HouseModel::class);
    }
    
    public function findAll()
    {
        return $this->findBy(array(), array('name' => 'ASC'));
    }
}
