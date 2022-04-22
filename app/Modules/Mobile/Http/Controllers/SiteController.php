<?php

namespace App\Modules\Mobile\Http\Controllers;

use App\Models\DefaultSearch;
use App\Models\HotSearch;
use App\Modules\Base\Http\Controllers\Mobile;
use App\Repositories\GoodsRepository;
use App\Repositories\RegionRepository;
use App\Repositories\ShopRepository;
use App\Repositories\ToolsRepository;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SiteController extends Mobile
{

    protected $regions;
    protected $tools;
    protected $goods;
    protected $shop;

    public function __construct()
    {
        parent::__construct();

        $this->regions = new RegionRepository();
        $this->tools = new ToolsRepository();
        $this->goods = new GoodsRepository();
        $this->shop = new ShopRepository();
    }

    public function user(Request $request)
    {
        $cat_id = $request->get('cat_id', '');

        // 默认搜索词
        $default_keywords = [];
        $default_search = DefaultSearch::where('is_show', 1)->orderBy('sort', 'asc')->get();
        if (!empty($default_search)) {
            foreach ($default_search as $v) {
                if ($v->search_type == 1 && $cat_id) {
                    $url = "/search.html?keyword=".$v->search_keywords;
                }
                if ($v->search_type == 1) {
                    if ($cat_id) {
                        $url = "/search.html?keyword=".$v->search_keywords;
                    }else {
                        continue;
                    }
                } else {
                    $url = "/search.html?keyword=".$v->search_keywords;
                }

                $default_keywords[] = [
                    'keyword' => $v->search_keywords,
                    'url' => $url,
                ];
            }
        }

        // 热搜词
        $show_keywords = [];
        $hot_search = HotSearch::where('is_show', 1)->select(['id','keyword','show_words'])->limit(10)->orderBy('sort', 'asc')->get();
        if (!empty($hot_search)) {
            foreach ($hot_search as $v) {
                $url = "search.html?keyword=".$v->keyword;
                $v->url = $url;
                $v->toArray();
            }
            $show_keywords = $hot_search[0];
        }
        // 搜索历史
        $search_records = !empty($_COOKIE['search_records']) ? unserialize($_COOKIE['search_records']) : [];
        $data = [
            'cart' => [
                'goods_count' => $this->cart_goods_num
            ],
            'message' => [
                'internal_count' => "0"
            ],
            'default_keywords' => $default_keywords,
            'hot_keywords' => $hot_search,
            'search_records' => $search_records,
            'show_keywords' => $show_keywords
        ];
        // 判断是否登录
        if (auth('user')->check()) {
            $user = $this->user;
            // 如果是登录状态
            $data['last_ip'] = $user->last_ip;
            $data['last_region_code'] = '';
            $data['last_time'] = $user->last_login;
            $data['last_time_format'] = $user->last_login;
            $data['user_name'] = $user->user_name;

            // 用户等级
            $user_rank = [];


        }

        return result(0, $data);
    }

    public function getSessionId(Request $request)
    {
        $session_id = md5($this->user_id); // todo 暂时用md5加密 用户id返回给前端 后面再看
        return result(0, $session_id);
    }

    public function getNewOrderList(Request $request)
    {

        $data = [
            [
                'headimg' => 'http://images.68mall.com/system/config/default_image/default_user_portrait_0.png',
                'user_name' => '鲜农乐一号门店管理员'
            ],
            [
                'headimg' => 'http://images.68mall.com/system/config/default_image/default_user_portrait_0.png',
                'user_name' => '鲜农乐一号门店管理员'
            ],
        ];
        $count = 20;

        return result(0, $data, '', ['count'=>$count]);
    }





    public function captcha(Request $request)
    {

//        return json_encode(['hash1' => 438,'hash2' => '438', 'url' => '/site/captcha.html?v='.uniqid()]);
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 100, $height = 40, $font = null);
        // 设置干扰线
        $builder->setMaxBehindLines(0);
        //获取验证码的内容
        $phrase = $builder->getPhrase();

        //把内容存入session
        Session::flash('laravelvipcaptcha', $phrase);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
//        $builder->output();
        $data = $builder->inline();
        return json_encode(['hash1' => 447,'hash2' => '447', 'url' => $data]);
    }


    /**
     * 异步加载地区
     *
     * @param Request $request
     * @return mixed
     */
//    public function regionList(Request $request)
//    {
//
//        // 判断传入的值是parent_code 还是 region_code
//        $parent_code = !is_null($request->get('parent_code')) ? $request->get('parent_code') : 0;
//        $field = 'parent_code';
//        $params = $request->all();
//
//        $level_names = [
//            0 => "",
//            1 => '省',
//            2 => '市',
//            3 => '区/县',
//            4 => '镇',
//            5 => '街道/村'
//        ];
//        $extras = [
//            'level_names' => $level_names,
//        ];
//
//        $region_names = [];
//        if (isset($params['region_code'])) {
//            // 查询region_names
//            $region_info = $this->regions->getByField('parent_code', $params['region_code']);
//            if (!empty($region_info)) {
//                $region_names[$params['region_code']] = $region_info->region_name;
//                $condition = [
//                    'where' => [[$field, $parent_code]],
//                    'limit' => 0
//                ];
//                list($region_list, $total) = $this->regions->getList($condition);
//
//                $data[0] = $region_list;
//
//            }
//            $extras['region_names'] = $region_names;
//            $parent_code = $request->get('region_code', 0);
////            $field = 'region_code';
//        }
//        $condition = [
//            'where' => [[$field, $parent_code]],
//            'limit' => 0
//        ];
//        list($region_list, $total) = $this->regions->getList($condition);
//
//
//
//        $data[0] = $region_list;
//        return result(0, $data, '', $extras);
//    }
    public function regionList(Request $request)
    {

        // 判断传入的值是parent_code 还是 region_code
        $parent_code = !is_null($request->get('parent_code')) ? $request->get('parent_code') : 0;
        $field = 'parent_code';
        $params = $request->all();

        $level_names = [
            0 => "",
            1 => '省',
            2 => '市',
            3 => '区/县',
            4 => '镇',
            5 => '街道/村'
        ];
        $extras = [
            'level_names' => $level_names,
        ];

        if (isset($params['region_code'])) {
            // 查询region_names
            $region_names = array_reverse(get_parent_region_list($params['region_code']));
            $region_names = array_column($region_names, 'region_name', 'region_code');
            $rr = array_keys($region_names);
            if (is_int($rr[0])) {
                array_unshift($rr, 0);
                if (count($rr) > 3) {
                    array_pop($rr); // 移除最后一个
                }
            }
            $data = [];
            foreach ($rr as $key=>$p_code) {
                $condition = [
                    'where' => [[$field, strval($p_code)]],
                    'limit' => 0,
                    'field' => [
                        'center', 'city_code', 'is_enable', 'is_scope', 'level',
                        'parent_code', 'region_code', 'region_id', 'region_name', 'region_type', 'sort'
                    ]
                ];
                list($region_list, $total) = $this->regions->getList($condition);
                $data[$key] = $region_list;
            }
            $extras['region_names'] = $region_names;

            return result(0, $data, '', $extras);
        } else {
            $field = 'parent_code';
            $condition = [
                'where' => [[$field, $parent_code]],
                'limit' => 0,
                'field' => [
                    'center', 'city_code', 'is_enable', 'is_scope', 'level',
                    'parent_code', 'region_code', 'region_id', 'region_name', 'region_type', 'sort'
                ]
            ];
            list($region_list, $total) = $this->regions->getList($condition);

            $data[0] = $region_list;
            return result(0, $data, '', $extras);
        }

    }

    /**
     * 用户上传图片
     *
     * @param Request $request
     * @return array
     */
    public function uploadImage(Request $request)
    {
        $filename = $request->post('img_base64', ''); // base64上传
        $base64Field = 'img_base64';
        $storePath = 'user/'.$this->user_id;
        $uploadRes = $this->tools->uploadPic($request, $filename, $storePath, false, $base64Field);

        if (isset($uploadRes['error'])) {
            // 上传出错
            return result(-1, '', $uploadRes['error']);
        }

        return result(0, $uploadRes['data'], '上传成功！', ['count' => $uploadRes['count']]);
    }

    /**
     * ajax渲染模板数据
     *
     * @param Request $request
     * @return array
     */
    public function tplData(Request $request)
    {
        $tpl_code = $request->get('tpl_code', '');

        // 滚动商品
        $goods_ids = $request->get('goods_ids', 0);
        $output = $request->get('output', 0); // 是否渲染输出html
        $shop_id = $request->get('shop_id', '');
        $is_last = $request->get('is_last', '');

        // 附近店铺
        $lat = $request->get('lat', '');
        $lng = $request->get('lng', '');


        // 列表
        $compact = [];
        if ($tpl_code == 'm_goods_list') {
            // 滚动商品
            $where = [];
            $where[] = ['goods_status',1]; // 商品状态 已发布
            $where[] = ['goods_audit',1]; // 审核通过
            $condition = [
                'where' => $where,
                'sortname' => 'goods_sort',
                'sortorder' => 'asc'
            ];

            if (!empty($goods_ids)) {
                $condition['in'] = [
                    'field' => 'goods_id',
                    'condition' => explode(',', $goods_ids)
                ];
            }

            list($m_goods_list, $m_goods_total) = $this->goods->getList($condition);
            $compact = compact('m_goods_list');
        } elseif ($tpl_code == 'm_near_shop') {
            // 附近店铺
            $where = [];
            $where[] = ['shop_status',1];
            $where[] = ['show_in_street',1];
            // 根据经纬度查询附近店铺 todo 待完成
            // ...

            $condition = [
                'where' => $where,
                'sortname' => 'shop_sort',
                'sortorder' => 'asc'
            ];
            list($m_near_shop, $total) = $this->shop->getList($condition);
            $compact = compact('m_near_shop');

        }

        $render = view('backend::site.'.$tpl_code, $compact)->render();
        return result(0, $render);
    }
}