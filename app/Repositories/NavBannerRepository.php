<?php

namespace App\Repositories;





use App\Models\NavBanner;

class NavBannerRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new NavBanner();
    }

}