<?php

namespace App\Repositories;

use App\Models\WeixinKeyword;

class WeixinKeywordRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new WeixinKeyword();
    }


}