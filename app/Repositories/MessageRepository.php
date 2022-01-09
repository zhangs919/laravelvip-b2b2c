<?php

namespace App\Repositories;



use App\Models\Message;

class MessageRepository
{
    use BaseRepository;

    protected $model;

    public function __construct()
    {
        $this->model = new Message();
    }

}