<?php

namespace App\Repositories;

use App\Models\SheetConfig;

class SheetConfigRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new SheetConfig();
    }

}