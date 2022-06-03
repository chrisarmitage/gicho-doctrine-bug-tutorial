<?php

namespace Application\Controller;

use Core\PongService;

class Index
{
    protected PongService $pongService;

    public function __construct(PongService $pongService)
    {
        $this->pongService = $pongService;
    }

    public function dispatch()
    {
        return [
            'version' => $this->pongService->pong('next-gen'),
        ];
    }
}
