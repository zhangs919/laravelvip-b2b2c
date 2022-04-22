<?php

namespace App\Repositories;





use App\Models\Navigation;

class NavigationRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new Navigation();
    }

}