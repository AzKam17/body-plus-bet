<?php

namespace App\Repository;

use App\Entity\MobileMoneyOperator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MobileMoneyOperator>
 *
 * @method MobileMoneyOperator|null find($id, $lockMode = null, $lockVersion = null)
 * @method MobileMoneyOperator|null findOneBy(array $criteria, array $orderBy = null)
 * @method MobileMoneyOperator[]    findAll()
 * @method MobileMoneyOperator[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MobileMoneyOperatorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MobileMoneyOperator::class);
    }

    public function save(MobileMoneyOperator $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MobileMoneyOperator $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MobileMoneyOperator[] Returns an array of MobileMoneyOperator objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MobileMoneyOperator
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
