<?php

namespace Datamart\MappingsBundle\Repository;
use Datamart\MappingsBundle\Entity\Civility;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * CivilityRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CivilityRepository extends \Doctrine\ORM\EntityRepository
{
    public function getCivilities($page)
    {
        $query = $this->createQueryBuilder('c')
            ->orderBy('c.id')
            ->getQuery();

        $query->setFirstResult(($page-1)*Civility::NB_CIVILITIES_PER_PAGE)
            ->setMaxResults(Civility::NB_CIVILITIES_PER_PAGE);

        return new Paginator($query);
    }

    public function searchCivilities($expression)
    {
        $query = $this->createQueryBuilder('c')
            ->getQuery();
    }
}
