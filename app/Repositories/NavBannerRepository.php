<?php

namespace App\Repositories;





use App\Models\NavBanner;

class NavBannerRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new NavBanner();
    }

    public function getNavBanner($page)
    {
        $cache_id = CACHE_KEY_NAV_BANNER[0]."_{$page}";
        if ($data = cache()->get($cache_id)) {
            return $data;
        }

        $navBannerCondition = [
            'where' => [
                ['nav_page', $page],
                ['is_show', 1]
            ],
            'limit' => 5, // 只取5个
            'sortname' => 'banner_sort',
            'sortorder' => 'asc'
        ];
        $data = $this->model->getList($navBannerCondition);
        cache()->put($cache_id, $data, CACHE_KEY_NAV_BANNER[1]);

        return $data;
    }
}