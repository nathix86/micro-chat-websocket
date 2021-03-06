<?php

namespace AppBundle\Repository;

/**
 * MessageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MessageRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Find messages by type and get user associated.
     *
     * @param string $type
     */
    public function findMessagesByTypeWithUser($type)
    {
        $q = $this->createQueryBuilder('m')
                  ->where('m.type = :type')
                  ->setParameter('type', $type)
                  ->leftJoin('m.user', 'u')
                  ->addSelect('u');

        return $q->getQuery()->getResult();
    }
}
