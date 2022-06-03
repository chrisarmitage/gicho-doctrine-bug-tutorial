<?php

namespace Application\Console;

use Core\PongService;

class Ping
{
    protected PongService $pongService;

    public function __construct(PongService $pongService)
    {
        $this->pongService = $pongService;
    }

    public function execute()
    {
        echo $this->pongService->pong("Ping Command") . PHP_EOL;
    }
}
