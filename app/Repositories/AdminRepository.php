<?php

namespace App\Repositories;


use App\Models\Admin;

class AdminRepository
{
    use BaseRepository;

    protected $model;

    public function __construct(Admin $admin)
    {
        $this->model = $admin;
    }

}