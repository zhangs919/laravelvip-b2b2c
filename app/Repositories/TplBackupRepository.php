<?php

namespace App\Repositories;


use App\Models\TplBackup;

class TplBackupRepository
{
    use BaseRepository;

    protected $model;

    public function __construct()
    {
        $this->model = new TplBackup();
    }



}