<?php

namespace App\Repository;

use App\Entity\Naming;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Naming|null find($id, $lockMode = null, $lockVersion = null)
 * @method Naming|null findOneBy(array $criteria, array $orderBy = null)
 * @method Naming[]    findAll()
 * @method Naming[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NamingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Naming::class);
    }

    // /**
    //  * @return Naming[] Returns an array of Naming objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Naming
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
