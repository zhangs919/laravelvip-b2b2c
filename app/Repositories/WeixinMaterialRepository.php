<?php

namespace App\Repositories;

use App\Models\WeixinMaterial;

class WeixinMaterialRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new WeixinMaterial();
    }


}