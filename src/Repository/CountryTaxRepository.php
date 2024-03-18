<?php

namespace App\Repository;

use App\Entity\CountryTax;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CountryTax>
 *
 * @method CountryTax|null find($id, $lockMode = null, $lockVersion = null)
 * @method CountryTax|null findOneBy(array $criteria, array $orderBy = null)
 * @method CountryTax[]    findAll()
 * @method CountryTax[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CountryTaxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CountryTax::class);
    }

    /**
     * @return bool|float|int|mixed|string|null
     */
    public function findTaxRateByCountryCode2(string $code2): mixed
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        return $qb->select('ct.taxRate')
            ->from($this->getClassName(), 'ct')
            ->join('ct.country', 'c')
            ->where('c.code2 = :code2')
            ->setParameter('code2', $code2)
            ->andWhere($qb->expr()->isNull('ct.archivedAt'))
            ->getQuery()->getSingleScalarResult();
    }

    /**
     * @return bool|float|int|mixed|string|null
     */
    public function findVatFormatByCountryCode2(string $code2): mixed
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('ct.vatFormat')
            ->from($this->getClassName(), 'ct')
            ->join('ct.country', 'c')
            ->where('c.code2 = :code2')
            ->setParameter('code2', $code2)
            ->andWhere($qb->expr()->isNull('ct.archivedAt'));

        try {
            return $qb->getQuery()->getSingleScalarResult();
        } catch (NoResultException $exception) {
            return null;
        }
    }
    //    /**
    //     * @return CountryTax[] Returns an array of CountryTax objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?CountryTax
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
