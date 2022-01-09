<?php

namespace App\Repositories;



use App\Models\ShopRole;

class ShopRoleRepository
{
    use BaseRepository;

    protected $model;

    public function __construct()
    {
        $this->model = new ShopRole();
    }

}