<?php

namespace App\Repositories;


use App\Models\Category;
use App\Models\GoodsType;

class GoodsTypeRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new GoodsType();
    }

}