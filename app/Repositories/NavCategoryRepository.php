<?php

namespace App\Repositories;




use App\Models\NavCategory;

class NavCategoryRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new NavCategory();
    }

}