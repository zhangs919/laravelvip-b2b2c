<?php

namespace App\Repositories;


use App\Models\HotSearch;

class HotSearchRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new HotSearch();
    }


}