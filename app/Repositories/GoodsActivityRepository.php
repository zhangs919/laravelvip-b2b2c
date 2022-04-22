<?php

namespace App\Repositories;


use App\Models\GoodsActivity;

class GoodsActivityRepository
{
    use BaseRepository;

    protected $model;

    protected $tree;


    public function __construct()
    {
        $this->model = new GoodsActivity();
    }

}