<?php

namespace App\Repositories;

use App\Models\GoodsTag;

class GoodsTagRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new GoodsTag();
    }

}