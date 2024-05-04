<?php

namespace App\Repositories;

use App\Models\Qcode;

class QcodeRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new Qcode();
    }


}