<?php

namespace App\Repositories;




use App\Models\NavWords;

class NavWordsRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new NavWords();
    }

}