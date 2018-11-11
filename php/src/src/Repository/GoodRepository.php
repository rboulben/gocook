<?php
/**
 * Created by PhpStorm.
 * User: remy
 * Date: 11/11/18
 * Time: 20:05
 */

namespace App\Repository;


class GoodRepository extends PaginatedRepository
{
    public function search($term, $order, $limit, $offset)
    {
        $qb = $this
            ->createQueryBuilder('a')
            ->select('a')
            ->orderBy('a.name', $order)
        ;

        if ($term) {
            $qb
                ->where('a.name LIKE ?1')
                ->setParameter(1, '%'.$term.'%')
            ;
        }

        return $this->paginate($qb, $limit, $offset);
    }
}