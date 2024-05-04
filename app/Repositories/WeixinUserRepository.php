<?php

namespace App\Repositories;


use App\Models\WeixinUser;

class WeixinUserRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new WeixinUser();
    }


}