<?php

namespace App\Repository;

use App\Entity\Igor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Igor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Igor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Igor[]    findAll()
 * @method Igor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IgorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Igor::class);
    }

    // /**
    //  * @return Igor[] Returns an array of Igor objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Igor
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
