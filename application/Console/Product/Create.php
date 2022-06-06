<?php

namespace Application\Console\Product;

use Bug\Product;
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
        $newProductName = $parsedTokens['name'] ?? null;

        if ($newProductName === null) {
            throw new \Exception('Missing param');
        }

        $product = new Product();
        $product->setName($newProductName);

        $this->entityManager->persist($product);
        $this->entityManager->flush();

        echo "Created Product with ID " . $product->id() . "\n";

    }
}
