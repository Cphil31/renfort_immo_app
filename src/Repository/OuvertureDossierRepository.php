<?php

namespace App\Repository;

use App\Entity\OuvertureDossier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OuvertureDossier>
 *
 * @method OuvertureDossier|null find($id, $lockMode = null, $lockVersion = null)
 * @method OuvertureDossier|null findOneBy(array $criteria, array $orderBy = null)
 * @method OuvertureDossier[]    findAll()
 * @method OuvertureDossier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OuvertureDossierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OuvertureDossier::class);
    }

    public function save(OuvertureDossier $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(OuvertureDossier $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return OuvertureDossier[] Returns an array of OuvertureDossier objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?OuvertureDossier
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
