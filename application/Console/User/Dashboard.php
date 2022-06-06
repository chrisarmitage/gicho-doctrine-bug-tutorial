<?php

namespace Application\Console\User;

use Bug\Bug;
use Doctrine\ORM\EntityManager;

class Dashboard
{
    protected EntityManager $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    public function execute($parsedTokens)
    {
        $dql = /** @lang DQL */ "SELECT b, e, r FROM Bug\Bug b JOIN b.engineer e JOIN b.reporter r ".
            "WHERE b.status = 'OPEN' AND (e.id = ?1 OR r.id = ?1) ORDER BY b.created DESC";

        $userId = $parsedTokens['id'];

        /** @var Bug[] $myBugs */
        $myBugs = $this->entityManager->createQuery($dql)
            ->setParameter(1, $userId)
            ->setMaxResults(15)
            ->getResult();

        echo "You have created or assigned to " . count($myBugs) . " open bugs:\n\n";

        foreach ($myBugs as $bug) {
            echo $bug->id() . " - " . $bug->description()."\n";
        }
    }
}
