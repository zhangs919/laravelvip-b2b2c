<?php

namespace App\Repositories;


use App\Models\Activity;

class ActivityRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new Activity();
    }


}