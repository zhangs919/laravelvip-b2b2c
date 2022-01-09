<?php

namespace App\Modules\Frontend\Http\Controllers;

use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\GoodsRepository;
use Illuminate\Http\Request;

class GuessController extends Frontend
{

    protected $goods;

    public function __construct()
    {
        parent::__construct();

        $this->goods = new GoodsRepository();

    }

    /**
     * 猜你喜欢
     *
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function like(Request $request)
    {
        $page = !empty($request->get('page')) ? $request->get('page') : 1;
        $num = $request->get('num',6);
        $tpl = $request->get('tpl', '');
        if (empty($tpl)) {
            return result(-1, null, '模板不存在');
        }
        // 猜你喜欢
        list($guess_like_goods, $total) = $this->goods->getGuessLikeGoods($page, $num);
        $page_total = ceil($total / $num);
        $user_like_page = $page;
        if ($page_total > $user_like_page) {
            $user_like_page++;
        }else {
            $user_like_page--;
        }

        $render = view('frontend.web.modules.library.'.$tpl, compact('guess_like_goods', 'user_like_page'))->render();
        return result(0, $render, '');
    }

}