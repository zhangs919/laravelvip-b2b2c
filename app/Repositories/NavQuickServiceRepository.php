<?php

namespace App\Repositories;




use App\Models\NavQuickService;

class NavQuickServiceRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new NavQuickService();
    }

}