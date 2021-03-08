<?php

namespace App\Repository;

use App\Entity\CauseType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CauseType|null find($id, $lockMode = null, $lockVersion = null)
 * @method CauseType|null findOneBy(array $criteria, array $orderBy = null)
 * @method CauseType[]    findAll()
 * @method CauseType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CauseTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CauseType::class);
    }

    // /**
    //  * @return CauseType[] Returns an array of CauseType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CauseType
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
