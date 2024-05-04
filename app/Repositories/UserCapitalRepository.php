<?php

namespace App\Repositories;

use App\Models\UserCapital;

class UserCapitalRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new UserCapital();
    }


}