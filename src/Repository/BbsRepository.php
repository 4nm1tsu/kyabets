<?php

namespace App\Repository;

use App\Entity\Bbs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Bbs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bbs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bbs[]    findAll()
 * @method Bbs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BbsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bbs::class);
    }

    // /**
    //  * @return Bbs[] Returns an array of Bbs objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bbs
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
