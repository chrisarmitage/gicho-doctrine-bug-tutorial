<?php

namespace Application\Listener;

class ProcessData
{
    public function execute($data)
    {
        echo 'Listener: [' . $data->timestamp . '] got number ' . $data->value . ' (' . json_encode($data) . ') ... ';

        $now = microtime(true);
        $target = $now + 5;

        while (microtime(true) <= $target) {
            // noop
        }

        echo 'Processed' . PHP_EOL;
    }
}
