<?php

namespace App\Repository;

use App\Entity\StatutTache;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StatutTache>
 *
 * @method StatutTache|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatutTache|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatutTache[]    findAll()
 * @method StatutTache[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatutTacheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatutTache::class);
    }

//    /**
//     * @return StatutTache[] Returns an array of StatutTache objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?StatutTache
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
