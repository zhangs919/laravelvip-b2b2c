<?php

namespace App\Repositories;


use App\Models\AdminRole;

class AdminRoleRepository
{
    use BaseRepository;

    protected $model;

    public function __construct()
    {
        $this->model = new AdminRole();
    }

}