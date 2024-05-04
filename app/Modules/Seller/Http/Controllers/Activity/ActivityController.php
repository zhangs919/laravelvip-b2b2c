<?php


namespace App\Modules\Seller\Http\Controllers\Activity;

use App\Modules\Base\Http\Controllers\Seller;
use Illuminate\Http\Request;

class ActivityController extends Seller
{

    public function picker(Request $request)
    {
        $params = $request->all();
        $uuid = make_uuid();
        $handle = $request->get('handle',''); // get_activity_list
        $shop_id = $request->get('shop_id','');
        $act_type = $request->get('act_type',''); // 活动类型 6-拼团活动

        if ($handle == 'get_activity_list') {
            return result(0, '');
        }

        $tpl = 'list';
        if ($request->method() == 'POST') {
            $tpl = 'partials._list';
        }

        $render = view('activity.activity.'.$tpl, compact('pageHtml', 'uuid'))->render();
        return result(0, $render);
    }
}