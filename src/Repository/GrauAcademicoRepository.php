<?php

namespace App\Repository;

use App\Entity\GrauAcademico;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GrauAcademico|null find($id, $lockMode = null, $lockVersion = null)
 * @method GrauAcademico|null findOneBy(array $criteria, array $orderBy = null)
 * @method GrauAcademico[]    findAll()
 * @method GrauAcademico[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GrauAcademicoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GrauAcademico::class);
    }

    // /**
    //  * @return GrauAcademico[] Returns an array of GrauAcademico objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GrauAcademico
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
