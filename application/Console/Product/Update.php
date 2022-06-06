<?php

namespace Application\Console\Product;

use Doctrine\ORM\EntityManager;

class Update
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
        $productId = $parsedTokens['id'] ?? null;
        $newName = $parsedTokens['name'] ?? null;

        if ($productId === null || $newName === null) {
            throw new \Exception('Missing param');
        }

        $product = $this->entityManager->find('Bug\Product', $productId);

        if ($product === null) {
            echo "No product found.\n";
            exit(1);
        }

        $product->setName($newName);

        $this->entityManager->flush();
    }
}
