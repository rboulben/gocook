<?php
/**
 * Created by PhpStorm.
 * User: remy
 * Date: 11/11/18
 * Time: 20:03
 */

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Pagerfanta\Adapter\DoctrineORMAdapter;
//use PagerFanta\Pagerfanta;

class PaginatedRepository extends EntityRepository
{
    protected function paginate(QueryBuilder $qb, $limit = 20, $offset = 1)
    {
        if (0 == $limit) {
            throw new \LogicException('$limit must be greater than 0.');
        }
        $offset = $offset ?? 1;

        $pager = new \Pagerfanta\Pagerfanta(new DoctrineORMAdapter($qb));
        $currentPage = ceil(($offset + 1) / $limit);

        $pager->setCurrentPage($currentPage);
        $pager->setMaxPerPage((int) $limit);

        return $pager;
    }
}
