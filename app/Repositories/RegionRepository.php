<?php

namespace App\Repositories;

use App\Models\Region;
use App\Services\Tree;
use Illuminate\Http\Request;


class RegionRepository
{
    use BaseRepository;

    protected $model;

    public function __construct()
    {
        $this->model = new Region();
    }

    public function checkScope($id)
    {
        $result = $this->model->checkState($id,'is_scope');
        return $result;
    }

    public function changeScope($id)
    {
        $ret = $this->model->changeState($id, 'is_scope');
        return $ret;
    }

    public function getAllRegions()
    {
        // 设置地区信息缓存
        $cache_id = CACHE_KEY_ALL_REGION[0];
        $list = cache()->get($cache_id);
        if ($list) {
            return $list;
        }

        $condition = [
            'where' => [['is_enable', 1]],
            'limit' => 0,
            'field' => [
                'center', 'parent_code', 'region_code', 'region_name'
            ],
            'sortname' => 'region_id',
            'sortorder' => 'asc'
        ];
        list($region_list, $total) = $this->model->getList($condition);
        $list = [];
        foreach ($region_list as $key=>$value) {
            $list[$key] = $value->toArray();
        }
        $list = (new Tree())->list_to_tree($list, 'region_code', 'parent_code', 'children', 0, false);
        cache()->put($cache_id, $list, CACHE_KEY_ALL_REGION[1]);
        return $list;
    }

    /**
     * 异步加载地区
     * @param Request $request
     * @return array
     */
    public function ajaxLoadRegions($request)
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
            $region_names = [];
            if ($params['region_code'] > 0) {
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
                        ],
                        'sortname' => 'region_id',
                        'sortorder' => 'asc'
                    ];
                    list($region_list, $total) = $this->model->getList($condition);
                    $data[$key] = $region_list;
                }
            } else {
                $condition = [
                    'where' => [[$field, 0]],
                    'limit' => 0,
                    'field' => [
                        'center', 'city_code', 'is_enable', 'is_scope', 'level',
                        'parent_code', 'region_code', 'region_id', 'region_name', 'region_type', 'sort'
                    ],
                    'sortname' => 'region_id',
                    'sortorder' => 'asc'
                ];
                list($region_list, $total) = $this->model->getList($condition);
                $data[] = $region_list;
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
                ],
                'sortname' => 'region_id',
                'sortorder' => 'asc'
            ];
            list($region_list, $total) = $this->model->getList($condition);

            $data[0] = $region_list;
            return result(0, $data, '', $extras);
        }
    }

    /**
     * 根据省市区获取地区编码
     *
     * @param string $names 如：云南省 昆明市 官渡区
     * @return string 如：53,01,11
     */
    public function getRegionCodesByNames($names)
    {
        $names_arr = explode(' ', $names);
        if (count($names_arr) != 3) {
            return '';
        }
        $region_province = Region::where('region_name', $names_arr[0])->first();
        if (empty($region_province)) {
            return '';
        }
        $region_city = Region::where([['region_name', $names_arr[1]],['parent_code', $region_province->region_code]])->first();
        if (empty($region_city)) {
            return '';
        }
        $region_district = Region::where([['region_name', $names_arr[2]],['parent_code', $region_city->region_code]])->first();
        if (empty($region_district)) {
            return '';
        }
        return $region_district->region_code;
    }
}