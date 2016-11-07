<?php

namespace Datamart\MappingsBundle\Repository;
use Datamart\MappingsBundle\Entity\Marketsegment;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * MarketsegmentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MarketsegmentRepository extends \Doctrine\ORM\EntityRepository
{
    public function getMarketsegments($page)
    {
        $query = $this->createQueryBuilder('ms')
            ->orderBy('ms.id')
            ->getQuery();

        $query->setFirstResult(($page-1)*Marketsegment::NB_MARKETSEGMENTS_PER_PAGE)
            ->setMaxResults(Marketsegment::NB_MARKETSEGMENTS_PER_PAGE);

        return new Paginator($query);
    }
}
