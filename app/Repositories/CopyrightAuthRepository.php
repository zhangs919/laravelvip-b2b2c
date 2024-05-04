<?php

namespace App\Repositories;

use App\Models\CopyrightAuth;

class CopyrightAuthRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new CopyrightAuth();
    }

    public function getCopyrightAuthList()
    {
        $cache_id = CACHE_KEY_COPYRIGHT_AUTH[0];
        if ($data = cache()->get($cache_id)) {
            return $data;
        }

        $copyCondition = [
            'where' => [
                ['is_show', 1]
            ],
            'sortname' => 'auth_sort',
            'sortorder' => 'asc'
        ];
        $data = $this->model->getList($copyCondition);

        cache()->put($cache_id, $data, CACHE_KEY_COPYRIGHT_AUTH[1]);

        return $data;
    }
}