<?php

namespace App\Repository;

use App\Entity\Room;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityRepository;


/**
 * @extends ServiceEntityRepository<Room>
 *
 * @method Room|null find($id, $lockMode = null, $lockVersion = null)
 * @method Room|null findOneBy(array $criteria, array $orderBy = null)
 * @method Room[]    findAll()
 * @method Room[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoomRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Room::class);
    }
/**
     * Enregistre une entité Room en base de données.
     *
     * @param Room $entity
     * @param bool $flush  Si vrai, exécute immédiatement la requête SQL.
     */
    public function save(Room $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
/**
     * Supprime une entité Room de la base de données.
     *
     * @param Room $entity
     * @param bool $flush  Si vrai, exécute immédiatement la requête SQL.
     */
    public function remove(Room $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    /**
     * Recherche les salles qui correspondent aux critères de recherche passés en paramètre.
     *
     * @param array $criteria  Tableau associatif contenant les critères de recherche.
     *
     * @return Room[]           Tableau des salles correspondantes.
     */
    public function findRoomBySearch(array $criteria)
    {
        $queryBuilder = $this->createQueryBuilder('r');
        // Joindre les tables des matériaux, logiciels et ergonomie pour pouvoir les utiliser dans la requête.
        $queryBuilder->join('r.material', 'm');
        $queryBuilder->join('r.software', 's');
        $queryBuilder->join('r.ergonomics', 'e');
        // Ajouter un critère sur la capacité de la salle si celui-ci est renseigné.
        if (isset($criteria['capacity'])) {
            $queryBuilder->andWhere('r.capacity >= :capacity')
                ->setParameter('capacity', $criteria['capacity']);
        }
        // Ajouter un critère pour chaque matériau sélectionné.
        foreach($criteria['material'] as $material){
            $queryBuilder->andWhere('m IN (:material)')
                ->setParameter('material', $material);
        }
        // Ajouter un critère pour chaque logiciel sélectionné.
        foreach($criteria['software'] as $software){
            $queryBuilder->andWhere('s IN (:software)')
                ->setParameter('software', $software);
        }
        // Ajouter un critère pour chaque caractéristique ergonomique sélectionnée.
        foreach($criteria['ergonomics'] as $ergonomic){
            $queryBuilder->andWhere('e IN (:ergonomics)')
                ->setParameter('ergonomics', $ergonomic);
        }
        
        return $queryBuilder->getQuery()->getResult();
    }
}



//    /**
//     * @return Room[] Returns an array of Room objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Room
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }