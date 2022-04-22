<?php

namespace app\Modules\Backend\Http\Controllers\Mall;


use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\CopyrightAuthRepository;
use Illuminate\Http\Request;

class CopyrightAuthController extends Backend
{

    private $links = [
        ['url' => 'mall/copyright-auth/list', 'text' => '资质导航列表'],
        ['url' => 'mall/copyright-auth/add', 'text' => '添加资质导航'], // 列表时不显示
        ['url' => 'mall/copyright-auth/edit', 'text' => '编辑资质导航'] // 列表时不显示
    ];

    protected $copyrightAuth;

    public function __construct()
    {
        parent::__construct();

        $this->copyrightAuth = new CopyrightAuthRepository();
    }


    public function lists(Request $request)
    {
        $title = '资质导航列表';
        $fixed_title = '资质导航 - '.$title;
        $this->sublink($this->links, 'list', '', '', 'add,edit');

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加资质导航'
            ],
        ];

        $explain_panel = [
            '资质导航展示在PC端前台页面底部，将以显示图标形式展示，平台可控制资质导航显示顺序以及是否显示'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
        $where = [];
        // 搜索条件
        $search_arr = ['key_word'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'key_word') {
                    $where[] = ['auth_name', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'auth_id',
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->copyrightAuth->getList($condition);

        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('mall.copyright-auth.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('mall.copyright-auth.list', $compact);
    }

    public function add(Request $request)
    {
        $title = '添加资质导航';
        $this->sublink($this->links, 'add', '', '', 'edit');

        $id = $request->get('id', 0);
        if ($id) {
            // 更新操作
            $title = '编辑资质导航';
            $info = $this->copyrightAuth->getById($id);
            view()->share('info', $info);

            $this->sublink($this->links, 'edit', '', '', 'add');

        }

        $fixed_title = '资质导航 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回资质导航列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('mall.copyright-auth.add', compact('title'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    public function saveData(Request $request)
    {
        $post = $request->post('CopyrightAuthModel');

        if (!empty($post['auth_id'])) {
            // 编辑
            $ret = $this->copyrightAuth->update($post['auth_id'], $post);
            $msg = '资质导航编辑';
        }else {
            // 添加
            $ret = $this->copyrightAuth->store($post);
            $msg = '资质导航添加';
        }

        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return redirect('/mall/copyright-auth/list');
        }
        // success
        flash('success', $msg.'成功');
        return redirect('/mall/copyright-auth/list');
    }

    public function setIsShow(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->copyrightAuth->changeState($id, 'is_show');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    public function editAuthInfo(Request $request)
    {
        $id = $request->post('id');
        $title = $request->post('title');
        $value = $request->post('value');

        if ($title == 'auth_sort') {
            $value = intval($value);
        }
        $ret = $this->copyrightAuth->update($id, [$title => $value]);

        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, '', '设置成功');
    }


    /**
     * 删除
     *
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        $ids = $request->post('ids');

        $ids_arr = explode(',', $ids);
        if (count($ids_arr) > 1) {
            $ret = $this->copyrightAuth->batchDel($ids);
        } else {
            $ret = $this->copyrightAuth->del($ids);
        }

        if ($ret === false) {
            // Log
            admin_log('资质导航删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }

        // Log
        admin_log('删除了一个资质导航。ID：'.$ids);
        return result(0, '', '删除成功');
    }

    public function batchDelete(Request $request)
    {
        $ids = $request->post('ids');
        $ret = $this->copyrightAuth->batchDel($ids);

        $ids = explode(',', $ids);
        if ($ret === false) {
            // Log
            admin_log('资质导航删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        admin_log('删除了多个资质导航。ID：'.$ids);
        return result(0, '', '删除成功');
    }
}