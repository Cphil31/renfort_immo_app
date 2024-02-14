<?php

namespace App\Repository;

use App\Entity\StatutIntervenant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StatutIntervenant>
 *
 * @method StatutIntervenant|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatutIntervenant|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatutIntervenant[]    findAll()
 * @method StatutIntervenant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatutIntervenantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatutIntervenant::class);
    }

    public function save(StatutIntervenant $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(StatutIntervenant $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return StatutIntervenant[] Returns an array of StatutIntervenant objects
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

//    public function findOneBySomeField($value): ?StatutIntervenant
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
