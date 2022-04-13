<?php

namespace App\Repository;

use App\Entity\Enderec;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Enderec|null find($id, $lockMode = null, $lockVersion = null)
 * @method Enderec|null findOneBy(array $criteria, array $orderBy = null)
 * @method Enderec[]    findAll()
 * @method Enderec[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnderecRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Enderec::class);
    }

    // /**
    //  * @return Enderec[] Returns an array of Enderec objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Enderec
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
