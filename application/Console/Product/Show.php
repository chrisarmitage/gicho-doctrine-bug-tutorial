<?php

namespace Application\Console\Product;

use Doctrine\ORM\EntityManager;

class Show
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

        if ($productId === null) {
            throw new \Exception('Missing param');
        }

        $product = $this->entityManager->find('Bug\Product', $productId);

        if ($product === null) {
            echo "No product found.\n";
            exit(1);
        }

        echo sprintf("-%s\n", $product->name());
    }
}
