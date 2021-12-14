<?php

namespace App\Repository;

use App\Entity\Livre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Livre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livre[]    findAll()
 * @method Livre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livre::class);
    }

     ///**
     // * @return Livre[] Returns an array of Livre objects
     // */

    public function findByPrixSup($prix)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.prix > :val')
            ->setParameter('val', $prix)
            ->orderBy('l.nbPages', 'ASC')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult()
        ;
    }
    public function findByPrixPages($x,$y)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.prix > :val AND  l.nbPages < :val1')
            ->setParameter('val' ,$x)
            ->setParameter('val1',$y)
            ->getQuery()
            ->getResult()
            ;
    }
    public function findByPrixPages10($prix,$nbPage)
    {


        return $this->createQueryBuilder('l')
            ->andWhere('l.prix > :val AND l.nbPages < :val1')
            ->setParameter('val', $prix)
            ->setParameter('val1', $nbPage)
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }

    public function findByPrixPagesTrie1($prix,$nbPage)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.prix > :val AND l.nbPages < :val1')
            ->setParameter('val', $prix)
            ->setParameter('val1', $nbPage)
            ->orderBy('l.nbPages', 'DESC')
            ->getQuery()
            ->getResult();
    }
    public function findByPrixPages10Trie($prix,$nbPage)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.prix > :val AND l.nbPages < :val1')
            ->setParameter('val', $prix)
            ->setParameter('val1', $nbPage)
            ->orderBy('l.prix', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    public function findByPrixPagesTrie2($prix,$nbPage)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.prix > :val AND l.nbPages < :val1')
            ->setParameter('val', $prix)
            ->setParameter('val1', $nbPage)
            ->orderBy('l.prix', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function DQlALL():array{
        $em = $this->getEntityManager();
        $requete = $em->createQuery(
            'SELECT l FROM App\Entity\Livre l '
        )->setMaxResults(10);
        return $requete->getResult();
    }
    public function DQlfindByPrixSup($prix):array{
        $em = $this->getEntityManager();
        $requete = $em->createQuery(
            'SELECT l FROM App\Entity\Livre l 
            WHERE l.prix > :s
            ORDER BY l.prix ASC'
        )->setParameter('s',$prix);
        return $requete->getResult();
    }

    public function DqlfindByPrixPages($prix, $nbpage):array{
        $em = $this->getEntityManager();
        $requete = $em->createQuery(
            'SELECT l FROM App\Entity\Livre l 
            WHERE l.prix > :s AND l.nbPages < :nb'
        )->setParameter('s',$prix)
        ->setParameter('nb', $nbpage);
        return $requete->getResult();
    }

    public function DqlfindByPrixPages10($prix, $nbpage):array{
        $em = $this->getEntityManager();
        $requete = $em->createQuery(
            'SELECT l FROM App\Entity\Livre l 
            WHERE l.prix > :s AND l.nbPages < :nb'
        )->setParameter('s',$prix)
            ->setParameter('nb', $nbpage)
        ->setMaxResults(10);
        return $requete->getResult();
    }

    public function DqlfindByPrixPagesTrie($prix, $nbpage):array{
        $em = $this->getEntityManager();
        $requete = $em->createQuery(
            'SELECT l FROM App\Entity\Livre l 
            WHERE l.prix > :s AND l.nbPages < :nb
            ORDER BY l.prix DESC'
        )->setParameter('s',$prix)
            ->setParameter('nb', $nbpage)
            ->setMaxResults(10);
        return $requete->getResult();
    }

    public function DqlfindByPrixPages10Trie($prix, $nbpage):array{
        $em = $this->getEntityManager();
        $requete = $em->createQuery(
            'SELECT l FROM App\Entity\Livre l 
            WHERE l.prix > :s AND l.nbPages < :nb
            ORDER BY l.prix DESC'
        )->setParameter('s',$prix)
            ->setParameter('nb', $nbpage)
            ->setMaxResults(10);
        return $requete->getResult();
    }

        /*
        public function findOneBySomeField($value): ?Livre
        {
            return $this->createQueryBuilder('l')
                ->andWhere('l.exampleField = :val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getOneOrNullResult()
            ;
        }
        */
}
