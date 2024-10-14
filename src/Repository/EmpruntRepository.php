<?php

namespace App\Repository;

use App\Entity\Emprunt;
use App\Entity\Objet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Emprunt>
 */
class EmpruntRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Emprunt::class);
    }

     /**
     * Vérifie si un objet est déjà emprunté pour une période donnée
     *
     * @param Objet $objet
     * @param \DateTime $dateStart
     * @param \DateTime $dateEnd
     * @return Emprunt[]
     */
    public function findEmprunts(Objet $objet, \DateTime $DateStart, \DateTime $DateEnd)
    {
        return $this->createQueryBuilder('e')
            ->where('e.objet = :objet')
            ->andWhere('e.DateStart < :DateEnd')
            ->andWhere('e.DateEnd > :DateStart')
            ->setParameter('objet', $objet)
            ->setParameter('DateStart', $DateStart)
            ->setParameter('DateEnd', $DateEnd)
            ->getQuery()
            ->getResult();
    }
    //    /**
    //     * @return Emprunt[] Returns an array of Emprunt objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Emprunt
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
