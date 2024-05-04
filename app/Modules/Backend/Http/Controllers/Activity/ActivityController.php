<?php


namespace App\Modules\Backend\Http\Controllers\Activity;

use App\Modules\Base\Http\Controllers\Backend;
use Illuminate\Http\Request;

class ActivityController extends Backend
{

    public function picker(Request $request)
    {
        $params = $request->all();
        $uuid = make_uuid();

        $tpl = 'list';
        if ($request->method() == 'POST') {
            $tpl = 'partials._list';
        }

        $render = view('activity.activity.'.$tpl, compact('pageHtml', 'uuid'))->render();
        return result(0, $render);
    }
}