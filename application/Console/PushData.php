<?php

namespace Application\Console;

class PushData
{
    public function execute()
    {
        $redis = new \Redis();
        $redis->connect('redis', 6379);

        for ($n = 1; $n <= 100; $n++) {
            $data = [
                'value'     => $n,
                'timestamp' => (new \DateTimeImmutable())->format('Y-m-d H:i:s')
            ];

            $queue = mt_rand(1, 10) < 8 ? 'test_pipeline.first' : 'test_pipeline.second';
            $redis->rpush($queue, json_encode($data));
        }
    }
}
