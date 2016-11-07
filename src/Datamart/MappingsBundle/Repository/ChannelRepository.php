<?php

namespace Datamart\MappingsBundle\Repository;
use Datamart\MappingsBundle\Entity\Channel;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * ChannelRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ChannelRepository extends \Doctrine\ORM\EntityRepository
{
    public function getChannels($page)
    {
        $query = $this->createQueryBuilder('c')
            ->orderBy('c.id')
            ->getQuery();
        
        $query->setFirstResult(($page-1)*Channel::NB_CHANNELS_PER_PAGE)
            ->setMaxResults(Channel::NB_CHANNELS_PER_PAGE);

        return new Paginator($query);
    }
}
