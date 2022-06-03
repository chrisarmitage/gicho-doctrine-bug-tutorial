<?php

namespace Core;

class PongService
{
    public function pong(string $input): string
    {
        return "Confirm: {$input}";
    }
}
