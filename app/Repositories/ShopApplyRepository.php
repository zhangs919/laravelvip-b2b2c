<?php

namespace App\Repositories;

use App\Models\ShopApply;

class ShopApplyRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new ShopApply();
    }


}