<?php

namespace App\Repositories;

use App\Models\Shipping;

class ShippingRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new Shipping();
    }

}