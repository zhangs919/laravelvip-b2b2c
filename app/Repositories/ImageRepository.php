<?php

namespace App\Repositories;

use App\Models\Image;

class ImageRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new Image();
    }
}