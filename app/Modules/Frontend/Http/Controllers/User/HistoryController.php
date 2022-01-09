<?php

namespace App\Modules\Frontend\Http\Controllers\User;

use App\Models\GoodsHistory;
use App\Modules\Base\Http\Controllers\UserCenter;
use App\Repositories\GoodsHistoryRepository;
use Illuminate\Http\Request;

class HistoryController extends UserCenter
{

    protected $goodsHistory;

    public function __construct()
    {
        parent::__construct();

        $this->goodsHistory = new GoodsHistoryRepository();
    }

    public function index(Request $request)
    {
        $seo_title = '用户中心';

        $list = $this->getHistoryList();

        if ($request->ajax()) { // ajax 加载列表
            $data = view('user.history.partials._list', compact('list'))->render();
            return result(0, $data);
        }

        $compact = compact('seo_title', 'list');

        return view('user.history.index', $compact);
    }

    public function delAll(Request $request)
    {
        $ret = GoodsHistory::where([['user_id', $this->user_id]])->delete();
        if ($ret === false) {
            return result(-1, null, '删除失败');
        }
        return result(0, null);
    }

    public function delete(Request $request)
    {
        $id = $request->get('id');
        if (!$id) {
            return  result(-1, null, '参数错误');
        }

        $ret = $this->goodsHistory->del($id);
        if ($ret === false) {
            return result(-1, null, '删除失败');
        }
        $list = $this->getHistoryList();
        $category_list = $this->getHistoryCategoryList();

        $data = view('user.history.partials._list', compact('list'))->render();
        $extra['tab'] = view('user.history.partials._cat_tab', compact('category_list'))->render();

        return result(0, $data, '删除成功！', $extra);
    }

    private function getHistoryList()
    {
        $condition = [
            'where' => [
                ['user_id', $this->user_id]
            ],
            'sortname' => 'created_at',
            'sortorder' => 'desc',
        ];
        list($list, $total) = $this->goodsHistory->getList($condition);

        return $list;
    }
    private function getHistoryCategoryList()
    {
        $list = [];
        return $list;
    }




}