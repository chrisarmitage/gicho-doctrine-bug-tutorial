<?php

namespace Application\Console\User;

use Bug\User;
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
        $name = $parsedTokens['name'] ?? null;

        if ($name === null) {
            throw new \Exception('Missing param');
        }

        $user = new User();
        $user->setName($name);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        echo "Created User with ID " . $user->id() . "\n";

    }
}
