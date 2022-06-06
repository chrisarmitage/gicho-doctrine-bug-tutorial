<?php

namespace Application\Console\Bug;

use Doctrine\ORM\EntityManager;

class Close
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
        $id = $parsedTokens['id'] ?? null;

        if ($id === null) {
            throw new \Exception('Missing param');
        }

        $bug = $this->entityManager->find("Bug\Bug", (int)$id);
        $bug->close();

        $this->entityManager->flush();
    }
}
