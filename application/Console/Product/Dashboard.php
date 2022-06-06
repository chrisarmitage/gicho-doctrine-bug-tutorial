<?php

namespace Application\Console\Product;

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
        $dql = /** @lang DQL */ "SELECT p.id, p.name, count(b.id) AS openBugs FROM Bug\Bug b ".
            "JOIN b.products p WHERE b.status = 'OPEN' GROUP BY p.id";

        $productBugs = $this->entityManager->createQuery($dql)->getScalarResult();

        foreach ($productBugs as $productBug) {
            echo $productBug['name']." has " . $productBug['openBugs'] . " open bugs!\n";
        }
    }
}
