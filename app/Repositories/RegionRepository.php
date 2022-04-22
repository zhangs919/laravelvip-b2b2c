<?php

namespace App\Repositories;

use App\Models\Region;


class RegionRepository
{
    use BaseRepository;

    protected $model;

    public function __construct()
    {
        $this->model = new Region();
    }

    public function checkScope($id)
    {
        $result = $this->model->checkState($id,'is_scope');
        return $result;
    }

    public function changeScope($id)
    {
        $ret = $this->model->changeState($id, 'is_scope');
        return $ret;
    }
}