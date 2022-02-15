<?php

namespace App\Repository;

use App\Entity\Instituicional;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Instituicional|null find($id, $lockMode = null, $lockVersion = null)
 * @method Instituicional|null findOneBy(array $criteria, array $orderBy = null)
 * @method Instituicional[]    findAll()
 * @method Instituicional[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InstituicionalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Instituicional::class);
    }

    // /**
    //  * @return Instituicional[] Returns an array of Instituicional objects
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
    public function findOneBySomeField($value): ?Instituicional
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
