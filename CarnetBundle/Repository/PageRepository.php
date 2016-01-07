<?php

namespace CarnetApp\CarnetBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PageRepository extends EntityRepository
{

    public function findAll()
    {

        $fields = array(
            'P.id AS id',
            'P.titre AS titre',
            'P.slug AS slug',
            'L.ville',
            'L.slug AS Lslug',
            'C.title',
            'C.slug AS Cslug');

        $query = $this->getEntityManager()->createQueryBuilder();
        $query
            ->select($fields)
            ->from('CarnetAppCarnetBundle:Page', 'P')
            ->leftjoin('P.lieu', 'L')
            ->leftjoin('L.carnet', 'C');

        return $query
            ->getQuery()
            ->getResult();

    }
}
