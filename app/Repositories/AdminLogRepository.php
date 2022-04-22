<?php

namespace App\Repositories;

use App\Models\AdminLog;

class AdminLogRepository
{
    use BaseRepository;

    protected $model;

    public function __construct()
    {
        $this->model = new AdminLog();
    }

}