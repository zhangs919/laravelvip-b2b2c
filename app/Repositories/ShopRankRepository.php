<?php

namespace App\Repositories;

use App\Models\ShopRank;

class ShopRankRepository
{
    use BaseRepository;

    protected $model;



    public function __construct()
    {
        $this->model = new ShopRank();
    }


}