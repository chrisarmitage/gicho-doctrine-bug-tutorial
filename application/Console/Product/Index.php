<?php

namespace Application\Console\Product;

use Doctrine\ORM\EntityManager;

class Index
{
    protected EntityManager $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    public function execute()
    {
        $productRepository = $this->entityManager->getRepository('Bug\Product');
        $products = $productRepository->findAll();

        foreach ($products as $product) {
            echo sprintf("-%s\n", $product->name());
        }
    }
}
