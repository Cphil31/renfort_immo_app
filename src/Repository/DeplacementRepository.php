<?php

namespace App\Repository;

use App\Entity\Deplacement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Deplacement>
 *
 * @method Deplacement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Deplacement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Deplacement[]    findAll()
 * @method Deplacement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeplacementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Deplacement::class);
    }

    public function save(Deplacement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Deplacement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function Bymonth(int $m ,int $y): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT * FROM deplacement
            WHERE MONTH(date) = :m AND YEAR(date) = :y ' ;
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['m'=> $m]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

   

//    /**
//     * @return Deplacement[] Returns an array of Deplacement objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Deplacement
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
