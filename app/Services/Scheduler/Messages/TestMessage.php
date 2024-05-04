<?php
namespace App\Services\Scheduler\Messages;


class TestMessage extends Message
{
    public $cmd = 'Scheduler:Test';

    public function __construct(array $params = [], int $delay = 10, string $key = '')
    {
        parent::__construct($params, $delay, $key);
    }
}
