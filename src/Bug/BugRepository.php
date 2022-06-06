<?php

namespace Bug;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class BugRepository extends EntityRepository
{
    protected EntityManager $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param $number
     * @return Bug[]
     */
    public function getRecentBugs($number = 30)
    {
        $dql = /** @lang DQL */ "SELECT b, e, r, p FROM Bug\Bug b JOIN b.engineer e ".
            "JOIN b.reporter r JOIN b.products p ORDER BY b.created DESC";

        $query = $this->entityManager->createQuery($dql);
        $query->setMaxResults($number);
        return $query->getArrayResult();
    }
}
