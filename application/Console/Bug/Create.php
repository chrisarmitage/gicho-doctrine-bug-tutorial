<?php

namespace Application\Console\Bug;

use Bug\Bug;
use Doctrine\ORM\EntityManager;

class Create
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
        $reporterId = $parsedTokens['reporter'] ?? null;
        $engineerId = $parsedTokens['engineer'] ?? null;
        $productIds = explode(',', $parsedTokens['products'] ?? []);

        if (
            $reporterId === null
            || $engineerId === null
            || empty($productIds)
        ) {
            throw new \Exception('Missing param');
        }

        $reporter = $this->entityManager->find("Bug\User", $reporterId);
        $engineer = $this->entityManager->find("Bug\User", $engineerId);
        if (!$reporter || !$engineer) {
            echo "No reporter and/or engineer found for the given id(s).\n";
            exit(1);
        }

        $bug = new Bug();
        $bug->setDescription('Something does not work');
        $bug->setCreated(new \DateTime('now'));
        $bug->setStatus('OPEN');

        foreach ($productIds as $productId) {
            $product = $this->entityManager->find("Bug\Product", $productId);
            $bug->assignToProduct($product);
        }

        $bug->setReporter($reporter);
        $bug->setEngineer($engineer);

        $this->entityManager->persist($bug);
        $this->entityManager->flush();

        echo "Created Bug with ID " . $bug->id() . "\n";

    }
}
