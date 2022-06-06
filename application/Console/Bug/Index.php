<?php

namespace Application\Console\Bug;

use Bug\BugRepository;

class Index
{
    protected BugRepository $repository;

    /**
     * @param BugRepository $repository
     */
    public function __construct(BugRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute($parsedTokens)
    {
        $bugs = $this->repository->getRecentBugs();

        foreach ($bugs as $bug) {
            echo $bug['description'] . " - " . $bug['created']->format('d.m.Y')."\n";
            echo "    Reported by: ".$bug['reporter']['name']."\n";
            echo "    Assigned to: ".$bug['engineer']['name']."\n";
            foreach ($bug['products'] as $product) {
                echo "    Platform: ".$product['name']."\n";
            }
            echo "\n";
        }
    }
}
