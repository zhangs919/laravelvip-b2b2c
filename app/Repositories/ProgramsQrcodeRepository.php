<?php

namespace App\Repositories;

use App\Models\ProgramsQrcode;

class ProgramsQrcodeRepository
{
    use BaseRepository;

    protected $model;

    public function __construct()
    {
        $this->model = new ProgramsQrcode();
    }


}