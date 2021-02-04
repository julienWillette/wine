<?php

namespace App\Repository;

use App\Entity\Wine;
use App\Data\SearchData;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Wine|null find($id, $lockMode = null, $lockVersion = null)
 * @method Wine|null findOneBy(array $criteria, array $orderBy = null)
 * @method Wine[]    findAll()
 * @method Wine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Wine::class);
    }

    /**
     * Récupère les produits en lien avec une recherche
     * @return Wine[]
     */
    public function findSearch(SearchData $search): array
    {
        $query = $this
            ->createQueryBuilder('p')
            ->select('c', 'n', 'r', 'p')
            ->join('p.color', 'c')
            ->join('p.naming', 'n')
            ->join('p.region', 'r');

            if(!empty($search->q)) {
                $query = $query
                    ->andWhere('p.name LIKE :q')
                    ->setParameter('q', "%{$search->q}%");
            }

            if(!empty($search->min)) {
                $query = $query
                    ->andWhere('p.price >= :min')
                    ->setParameter('min', $search->q);
            }

            if(!empty($search->max)) {
                $query = $query
                    ->andWhere('p.price <= :max')
                    ->setParameter('max', $search->q);
            }

            if(!empty($search->color)) {
                $query = $query
                    ->andWhere('c.id IN (:color)')
                    ->setParameter('color', $search->color);
            }

            if(!empty($search->naming)) {
                $query = $query
                    ->andWhere('n.id IN (:naming)')
                    ->setParameter('naming', $search->naming);
            }

            if(!empty($search->region)) {
                $query = $query
                    ->andWhere('r.id IN (:region)')
                    ->setParameter('region', $search->region);
            }


        return $query->getQuery()->getResult();
    }

    // /**
    //  * @return Wine[] Returns an array of Wine objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Wine
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
