<?php
/**
 * Created by PhpStorm.
 * User: moi
 * Date: 05/01/2016
 * Time: 11:08
 */

namespace CarnetApp\BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;

class BlogRepository extends EntityRepository
{

    public function findArticleWithInfo($em)
    {
        $rq = "SELECT A.title AS articleTitre, A.slug, A.actived, A.image, A.publied, U.username, (SELECT count(*) FROM carnet2voyage__blogComment WHERE arcticle_id = A.id) AS commentNb, Cat.title FROM carnet2voyage__blogArticle AS A JOIN carnet2voyage__blogCategory AS Cat ON Cat.id = A.category_id JOIN commun__user AS U ON U.id = A.autor_id";

        $connection = $em->getConnection();
        $statement = $connection->prepare($rq);
        $statement->execute();
        $results = $statement->fetchAll();

        return $results;
    }

    public function findCategoyWithInfo($em)
    {
        $rq = "SELECT *,(SELECT count(*) FROM `carnet2voyage__blogArticle` WHERE category_id = C.id) AS articleNb FROM carnet2voyage__blogCategory AS C";

        $connection = $em->getConnection();
        $statement = $connection->prepare($rq);
        $statement->execute();
        $results = $statement->fetchAll();

        return $results;
    }

}
