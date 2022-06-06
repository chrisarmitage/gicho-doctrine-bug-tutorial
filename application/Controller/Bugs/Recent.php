<?php

namespace Application\Controller\Bugs;

use Bug\BugRepository;

class Recent
{
    protected BugRepository $repository;

    /**
     * @param BugRepository $repository
     */
    public function __construct(BugRepository $repository)
    {
        $this->repository = $repository;
    }

    public function dispatch()
    {
        return $this->repository->getRecentBugs();
    }
}
