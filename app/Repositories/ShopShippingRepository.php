<?php

namespace App\Repositories;


use App\Models\ShopShipping;

class ShopShippingRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new ShopShipping();
    }

}