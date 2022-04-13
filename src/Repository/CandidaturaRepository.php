<?php

namespace App\Repository;

use App\Entity\Candidatura;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Candidatura|null find($id, $lockMode = null, $lockVersion = null)
 * @method Candidatura|null findOneBy(array $criteria, array $orderBy = null)
 * @method Candidatura[]    findAll()
 * @method Candidatura[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CandidaturaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Candidatura::class);
    }

    // /**
    //  * @return Candidatura[] Returns an array of Candidatura objects
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
    public function findOneBySomeField($value): ?Candidatura
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
