<?php

namespace CarnetApp\CarnetBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CarnetRepository extends EntityRepository
{
    /**
     * affiche les carnets dans l'accueil coté client
     * @return array
     */
    public function findAllActived()
    {

        $qb = $this->createQueryBuilder('p');
        $qb->where('p.actived = true');
        $qb->orderBy('p.depart', 'DESC');

        return $qb
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $em
     * @param $carnetId
     * @return mixed
     */
    public function findPath($em,$carnetId)
    {
        $rq = "SELECT ville,lat,lng,date_arrived,date_departure,slug FROM carnet2voyage__lieux WHERE carnet_id = $carnetId AND use_in_path IS true ORDER BY date_arrived ASC";

        $connection = $em->getConnection();
        $statement = $connection->prepare($rq);
        $statement->execute();
        $results = $statement->fetchAll();

        return $results;
    }
}
