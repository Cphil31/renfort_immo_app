<?php

namespace App\Repository;

use App\Entity\StatutEtatDesLieux;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StatutEtatDesLieux>
 *
 * @method StatutEtatDesLieux|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatutEtatDesLieux|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatutEtatDesLieux[]    findAll()
 * @method StatutEtatDesLieux[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatutEtatDesLieuxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatutEtatDesLieux::class);
    }

    public function save(StatutEtatDesLieux $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(StatutEtatDesLieux $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return StatutEtatDesLieux[] Returns an array of StatutEtatDesLieux objects
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

//    public function findOneBySomeField($value): ?StatutEtatDesLieux
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
