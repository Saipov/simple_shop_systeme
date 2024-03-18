<?php

namespace App\Repository;

use App\Entity\ProductDiscount;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use function Doctrine\ORM\QueryBuilder;

/**
 * @extends ServiceEntityRepository<ProductDiscount>
 *
 * @method ProductDiscount|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductDiscount|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductDiscount[]    findAll()
 * @method ProductDiscount[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductDiscountRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductDiscount::class);
    }

    public function findProductDiscount(string $couponCode)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        return $qb->select('pd')
            ->from($this->getClassName(), 'pd')
            ->andWhere('pd.couponCode = :coupon_code')
            ->setParameter('coupon_code', $couponCode)
            ->andWhere($qb->expr()->isNull('pd.archivedAt'))
            ->andWhere($qb->expr()->isNull('pd.deletedAt'))
            ->andWhere('pd.isActive = :active')
            ->setParameter('active', true)
            ->getQuery()->getOneOrNullResult();
    }
    //    /**
    //     * @return ProductDiscount[] Returns an array of ProductDiscount objects
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

    //    public function findOneBySomeField($value): ?ProductDiscount
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
