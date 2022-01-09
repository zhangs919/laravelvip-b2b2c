<?php

namespace App\Repositories;




use App\Models\SmsLog;

class SmsLogRepository
{
    use BaseRepository;

    protected $model;

    public function __construct()
    {
        $this->model = new SmsLog();
    }


    public function getSmsLogCount($where = [])
    {
        $data = $this->model->where($where)->count();

        return $data;
    }

    public function getSmsLogInfo($where = [])
    {
        $data = $this->model->where($where)->first();

        return $data;
    }
}