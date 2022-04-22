<?php

namespace App\Repositories;

use App\Models\TemplateCat;

class TemplateCatRepository
{
    use BaseRepository;

    protected $model;

    public function __construct()
    {
        $this->model = new TemplateCat();
    }

}