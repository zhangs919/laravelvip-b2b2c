<?php

namespace App\Repositories;


use App\Models\ShopLog;

class ShopLogRepository
{
    use BaseRepository;

    protected $model;

    public function __construct()
    {
        $this->model = new ShopLog();
    }

}