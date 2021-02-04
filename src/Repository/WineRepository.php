<?php

namespace App\Repository;

use App\Entity\Wine;
use App\Data\SearchData;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Wine|null find($id, $lockMode = null, $lockVersion = null)
 * @method Wine|null findOneBy(array $criteria, array $orderBy = null)
 * @method Wine[]    findAll()
 * @method Wine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Wine::class);
        $this->paginator = $paginator;
    }

    /**
     * Récupère les produits en lien avec une recherche
     * @return PaginationInterface
     */
    public function findSearch(SearchData $search): PaginationInterface
    {
        $query = $this->getSearchQuery($search)->getQuery();
        return $this->paginator->paginate(
            $query,
            $search->page,
            6
        );
    }

    /**
     * Récupère le prix minimum et maximum correspondant à une recherche
     * @return integer[]
     */
    public function findMinMax(SearchData $search): array
    {
        $results = $this->getSearchQuery($search, true)
            ->select('MIN(p.price) as min', 'MAX(p.price) as max')
            ->getQuery()
            ->getScalarResult();
        return[(int)$results[0]['min'], (int)$results[0]['max']];

    }

    private function getSearchQuery(SearchData $search, $ignorePrice = false): QueryBuilder
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

            if(!empty($search->min) && $ignorePrice === false) {
                $query = $query
                    ->andWhere('p.price >= :min')
                    ->setParameter('min', $search->min);
            }

            if(!empty($search->max) && $ignorePrice === false) {
                $query = $query
                    ->andWhere('p.price <= :max')
                    ->setParameter('max', $search->max);
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
            return $query;
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
