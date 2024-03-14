<?php

namespace App\Repository;

use App\Entity\ProductTransaction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProductTransaction>
 *
 * @method ProductTransaction|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductTransaction|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductTransaction[]    findAll()
 * @method ProductTransaction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductTransactionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductTransaction::class);
    }

    //    /**
    //     * @return ProductTransaction[] Returns an array of ProductTransaction objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ProductTransaction
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
