<?php

namespace App\Repository;

use App\Entity\LogBalance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LogBalance>
 *
 * @method LogBalance|null find($id, $lockMode = null, $lockVersion = null)
 * @method LogBalance|null findOneBy(array $criteria, array $orderBy = null)
 * @method LogBalance[]    findAll()
 * @method LogBalance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LogBalanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LogBalance::class);
    }

//    /**
//     * @return LogBalance[] Returns an array of LogBalance objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?LogBalance
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
