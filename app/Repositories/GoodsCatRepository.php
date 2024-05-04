<?php

namespace App\Repositories;

use App\Models\GoodsCat;

class GoodsCatRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new GoodsCat();
    }

}