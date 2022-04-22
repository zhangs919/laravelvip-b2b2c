<?php

namespace App\Repositories;

use App\Models\UserShopRank;

class UserShopRankRepository
{
    use BaseRepository;

    protected $model;



    public function __construct()
    {
        $this->model = new UserShopRank();
    }


}