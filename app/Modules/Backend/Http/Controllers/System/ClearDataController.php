<?php

namespace App\Modules\Backend\Http\Controllers\System;


use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\ClearDataRepository;
use Illuminate\Http\Request;

class ClearDataController extends Backend
{

    protected $clearData;

    public function __construct(ClearDataRepository $clearData)
    {
        parent::__construct();

        $this->clearData = $clearData;

    }

    public function index(Request $request)
    {
        $title = '列表';
        if ($request->method() == 'POST') {
            // 执行清除相应数据操作
            $codes = $request->post('codes');
            $ret = $this->clearData->clearData($codes);
            if (!$ret) {
                admin_log('清测试数据失败');
                return result(-1, null, '清测试数据失败！');
            }

            admin_log('清测试数据成功');
            return result(0, '', '清测试数据成功！');
        }

        return view('system.clear-data.index', compact('title'));
    }


}