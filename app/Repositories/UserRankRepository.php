<?php

namespace App\Repositories;

use App\Models\UserRank;

class UserRankRepository
{
    use BaseRepository;

    protected $model;



    public function __construct()
    {
        $this->model = new UserRank();
    }


}