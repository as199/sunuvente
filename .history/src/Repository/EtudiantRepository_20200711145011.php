<?php

namespace App\Repository;

use App\Entity\Etudiant;
use App\Entity\Recherche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Etudiant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etudiant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etudiant[]    findAll()
 * @method Etudiant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudiantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etudiant::class);
    }

    public function findEtudiant(Recherche $search)
    {
        $query = $this->createQueryBuilder('e');
        if ($search->getMatricule()) {
            $query = $query
                ->where('e.matricule = :matricule')
                ->setParameter('matricule', $search->getMatricule());
        }
        if ($search->getTelephone()) {
            $query = $query
                ->where('e.telephone = :telephone')
                ->setParameter('telephone', $search->getTelephone());
        }
        if ($search->getPrenom()) {
            $query = $query
                ->where('e.prenom = :prenom')
                ->setParameter('prenom', $search->getPrenom());
        }
        if ($search->getNom()) {
            $query = $query
                ->where('e.nom = :nom')
                ->setParameter('nom', $search->getNom());
        }
        return $query->getQuery();
    }

    public function findEtuByChambre($numchambre)
    {
        $query = $query
            ->where('e.chambre = :chambre')
            ->setParameter('chambre', $search->getNom());
    }

    // /**
    //  * @return Etudiant[] Returns an array of Etudiant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Etudiant
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
