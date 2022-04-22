<?php

namespace App\Repositories;

use App\Models\ShopQuestions;

class ShopQuestionsRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new ShopQuestions();
    }



}