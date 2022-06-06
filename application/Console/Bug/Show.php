<?php

namespace Application\Console\Bug;

use Bug\Bug;
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

        $bugId = $parsedTokens['id'];
        /** @var Bug $bug */
        $bug = $this->entityManager->find("Bug\Bug", (int)$bugId);

        echo "Bug: ".$bug->description()."\n";
        echo "Reporter: ".$bug->reporter()->name()."\n";
        echo "Engineer: ".$bug->engineer()->name()."\n";
    }
}
