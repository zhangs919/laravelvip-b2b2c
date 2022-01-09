<?php

namespace App\Repositories;

use App\Models\ShopNavigation;

class ShopNavigationRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new ShopNavigation();
    }


}