<?php

namespace App\Repositories;





use App\Models\NavAd;

class NavAdRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new NavAd();
    }

}