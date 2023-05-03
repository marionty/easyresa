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

    public function save(Room $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Room $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function findRoomBySearch(array $criteria)
    {
        $queryBuilder = $this->createQueryBuilder('r');
        $queryBuilder->join('r.material', 'm');
        $queryBuilder->join('r.software', 's');
        $queryBuilder->join('r.ergonomics', 'e');

        foreach($criteria['material'] as $material){
            $queryBuilder->andWhere('m IN (:material)')
                ->setParameter('material', $material);
        }
        
        foreach($criteria['software'] as $software){
            $queryBuilder->andWhere('s IN (:software)')
                ->setParameter('software', $software);
        }
        
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