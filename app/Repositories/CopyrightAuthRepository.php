<?php

namespace App\Repositories;

use App\Models\CopyrightAuth;

class CopyrightAuthRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new CopyrightAuth();
    }
}