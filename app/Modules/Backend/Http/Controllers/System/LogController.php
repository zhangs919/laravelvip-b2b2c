<?php

namespace App\Modules\Backend\Http\Controllers\System;


use App\Models\Admin;
use App\Models\AdminLog;
use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\AdminLogRepository;
use App\Repositories\SystemConfigRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LogController extends Backend
{

    private $links = [
        ['url' => 'system/log/list', 'text' => '列表'],
        ['url' => 'system/log/set', 'text' => '设置'],
    ];

    protected $adminLog;
    protected $systemConfig;


    public function __construct(AdminLogRepository $adminLogRepository,SystemConfigRepository $systemConfig)
    {
        parent::__construct();

        $this->adminLog = $adminLogRepository;
        $this->systemConfig = $systemConfig;
    }


    public function lists(Request $request)
    {
        $title = '列表';
        $fixed_title = '操作日志 - 列表';
        $this->sublink($this->links, 'list');

        $explain_panel = [
            '站点管理员的所有关键操作会被记录到操作日志中，便于查看',
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
        $where = [];
        // 搜索条件
        $search_arr = ['admin_id', 'content'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'content') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'created_at',
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->adminLog->getList($condition);

        $pageHtml = pagination($total);

        $admin_list = Admin::all()->toArray();

        $compact = compact('title', 'list', 'total', 'pageHtml','admin_list');
        if ($request->ajax()) {
            $render = view('system.log.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('system.log.list', $compact);
    }

    public function set(Request $request)
    {
        $group = 'log';

        $title = '设置';

        $fixed_title = '操作日志 - 设置';
        $this->sublink($this->links, 'set');

        $uuid = make_uuid();
        $script_render = view('system.config.partials.'.$group, compact('uuid'))->render();
        $group_info = $this->systemConfig->getConfigList($group);
        $introduce_box = '';

        $explain_panel = [
            '操作日志开启与关闭由平台方控制，开启操作日志可以记录管理人员的关键操作，但会轻微加重系统负担'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('system.config.config', compact('title', 'group', 'group_info', 'script_render', 'introduce_box'));
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->adminLog->del($id);
        if ($ret === false) {
            // Log
            admin_log('操作日志删除失败。ID：'.$id);
            return result(-1, '', '删除失败');
        }

        // Log
        admin_log('操作日志删除成功。ID：'.$id);
        return result(0, '', '删除成功');
    }

    public function batchDelete(Request $request)
    {
        $ids = $request->post('ids');
        $ret = $this->adminLog->batchDel($ids);

        $ids = implode(',', $ids);
        if ($ret === false) {
            // Log
            admin_log('操作日志批量删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        admin_log('操作日志批量删除成功。ID：'.$ids);
        return result(0, '', '删除成功');
    }

    /**
     * 删除六个月前的操作日志
     *
     * @return mixed
     */
    public function deleteOldLog()
    {
        // 六个月前的时间
        $time = Carbon::parse('-6 months', 'Asia/Shanghai');
        $ret = AdminLog::where('created_at', '<', $time)->delete();

        if ($ret === false) {
            // Log
            admin_log('六个月前的操作日志删除失败。');
            return result(-1, '', '删除失败');
        }
        // Log
        admin_log('六个月前的操作日志删除成功。');
        return result(0, '', '删除成功');
    }
}