<?php

namespace App\Repository;

use App\Entity\Jewelry;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Jewelry|null find($id, $lockMode = null, $lockVersion = null)
 * @method Jewelry|null findOneBy(array $criteria, array $orderBy = null)
 * @method Jewelry[]    findAll()
 * @method Jewelry[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JewelryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Jewelry::class);
    }

    /**
     * @return Jewelry[]
     */
    public function findBySale(): array
    {
        return $this->findAllQuery()
            ->getQuery()
            ->getResult()
        ;
    }
    
    /**
     * @return Jewelry[]
     */
    public function findLatest(): array
    {
        return $this->findAllQuery()
            ->setMaxResults(4)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Jewelry[]
     */
    public function findByCategory($value): array
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.category = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    private function findAllQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.sale = false')
        ;
    }

    // /**
    //  * @return Jewelry[] Returns an array of Jewelry objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Jewelry
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
