<?php

namespace App\Repository;

use App\Entity\KeysEncryption;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method KeysEncryption|null find($id, $lockMode = null, $lockVersion = null)
 * @method KeysEncryption|null findOneBy(array $criteria, array $orderBy = null)
 * @method KeysEncryption[]    findAll()
 * @method KeysEncryption[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KeysEncryptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, KeysEncryption::class);
    }

    // /**
    //  * @return KeysEncryption[] Returns an array of KeysEncryption objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?KeysEncryption
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
