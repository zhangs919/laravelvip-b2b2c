<?php

namespace App\Api\Foundation\Transformer;


abstract class Transformer
{
    public function transformCollect(array $map)
    {
        return array_map(array($this, 'transform'), $map);
    }

    abstract public function transform($map);
}
