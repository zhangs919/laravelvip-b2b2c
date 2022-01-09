<?php

namespace App\Repositories;


use App\Models\ActivityCategory;

class ActivityCategoryRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new ActivityCategory();
    }


}