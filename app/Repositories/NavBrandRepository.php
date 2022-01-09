<?php

namespace App\Repositories;





use App\Models\NavBrand;

class NavBrandRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new NavBrand();
    }

}