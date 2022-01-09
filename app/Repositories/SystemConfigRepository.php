<?php

namespace App\Repositories;

use App\Models\SystemConfig;

class SystemConfigRepository
{

    use BaseRepository;

    protected $model;

    public function __construct()
    {

        $this->model = new SystemConfig();
    }

    public function detail($condition)
    {
        $data = $this->model->where($condition)->firstOrFail();
        return $data;
    }

    /**
     * 配置管理 获取配置项列表
     *
     * @param array $condition
     * @param string $column
     * @return array
     */
    public function getConfigsByGroup($condition = [], $column = '')
    {
        if (!empty($condition['where'])) {
            $condition['where'] = $this->construct_condition($condition['where']);
        }

        $data = $this->model->getList($condition, $column);

        if (!empty($data[0])) {
            foreach ($data[0] as &$datum) {
                $datum = $datum[0];
            }
        }
        return $data;
    }

    /**
     * 后台获取特殊的配置项数据
     *
     * @param $group
     * @param string $column
     * @return mixed
     */
    public function getSpecialConfigsByGroup($group, $column = '')
    {
        $condition = [
            'where' => [['status', 1],['group', $group]],
            'sortname' => 'sort',
            'sortorder' => 'asc',
            'limit' => 0
        ];
        list($list,$total) = $this->model->getList($condition, $column);

        if (!empty($list)) {
            foreach ($list as $key=>$item) {
                $item = $item[0];

                if($item->type == 'checkbox') {
                    $item->value = explode(',', $item->value);
                }

                // 特殊值处理
                if ($item->code == 'use_fee_value' && is_string($item->value)) {
                    // 平台使用费值 反序列化
                    $item->value = unserialize($item->value);
                }

                // 特殊值处理 shipping_time 发货时间
                if ($item->code == 'shipping_time' && !empty($item->value)) {
                    $shipping_time = json_decode($item->value,true);
                    $begin_hour = $shipping_time['begin_hour'];
                    $begin_minute = $shipping_time['begin_minute'];
                    $end_hour = $shipping_time['end_hour'];
                    $end_minute = $shipping_time['end_minute'];
                    $shipping_time['time_arr'] = [];
                    foreach ($begin_hour as $bhk=>$bhv) {
                        $shipping_time['time_arr'][] = [
                            'begin_hour' => $bhv,
                            'begin_minute' => $begin_minute[$bhk],
                            'end_hour' => $end_hour[$bhk],
                            'end_minute' => $end_minute[$bhk],
                        ];
                    }
                    $item->value = json_encode($shipping_time);
                }

                $list[$key] = $item;
            }
        }

        return $list;
    }

    /**
     * 获取配置分组列表
     *
     * @return array
     */
    public function getConfigGroups()
    {
        // 配置分组信息
//        $list_group = sysconf('config_group');
//        $list_group = preg_split('/\s+/', $list_group);

        $list_group = get_config_group();
        $tab_list = [];
        /*foreach ($list_group as $key => $value) {
            $values = explode(':', $value);

            $tab_list[$key]['name'] = $values[0];
            $tab_list[$key]['title'] = $values[1];
        }*/
        foreach ($list_group as $key => $value) {
            $tab_list[$key]['name'] = $value['code'];
            $tab_list[$key]['title'] = $value['title'];
        }

        return $tab_list;
    }

    /**
     * 获取配置表单类型列表
     *
     * @return array
     */
    public function getFormItemTypes()
    {
        // 配置分组信息
//        $list_group = sysconf('form_item_type');
//        $list_group = preg_split('/\s+/', $list_group);
        $list_group = get_form_item_type();

        $tab_list = [];
        /*foreach ($list_group as $key => $value) {
            $values = explode(':', $value);
            $tab_list[$key]['name'] = $values[0];
            $tab_list[$key]['title'] = $values[1];
        }*/

        foreach ($list_group as $key => $value) {
            $tab_list[$key]['name'] = $value['name'];
            $tab_list[$key]['title'] = $value['title'];
        }

        return $tab_list;
    }

    public function getConfigList($group)
    {
        $group_info = get_config_group($group);
        if ($group_info === false) {
            return false;
        }
        if (!empty($group_info['anchor'])) {
            foreach ($group_info['anchor'] as $anchor) {
                $list = $this->model->where(['group'=>$group,'status'=>1,'anchor'=>$anchor])->orderBy('sort', 'asc')->get();
                $group_info['list'][] = [
                    'anchor' => $anchor,
                    'config_list' => $this->format_config($list)
                ];
            }
        }else {
            $list = $this->model->where(['group'=>$group,'status'=>1])->orderBy('sort', 'asc')->get();
            $group_info['list'] = $this->format_config($list);
        }
        return $group_info;
    }

    private function format_config($config_list)
    {
//        dd($config_list);
        foreach ($config_list as $key=>$vo) {

            $vo = $vo->toArray();

            // 如果表单类型是 单选、多选、下拉、联动等类型
            if($vo['type'] == 'radio' || $vo['type'] == 'checkbox' || $vo['type'] == 'select' || $vo['type'] == 'linkage' || $vo['type'] == 'linkages' || $vo['type'] == 'switch'){
//                dd(preg_split('/\s+/', $vo['options']));
//                $options = preg_split('/\s+/', $vo['options']);
                $options = explode("\r\n", $vo['options']);

                $optionsData = [];
                foreach ($options as $option){
                    $optionsValue = explode('::',$option);
                    $optionsData[$optionsValue[0]] = $optionsValue[1];
                }


                $config_list[$key]['options'] = $optionsData;
            }

            // 如果表单类型是 多选类型 则将value值转换为数组
            // TODO 此处有bug
            if($vo['type'] == 'checkbox') {
//                        $vo['value'] = explode(':', $vo['value']);
                $config_list[$key]['value'] = explode(',', $vo['value']);
//                        dump($vo['value']);die;
            }

            //如果是图片组类型 将value以|分隔
            if ($vo['type'] == 'imagegroup') {
                $config_list[$key]['mode'] = 0;
                if (!empty($vo['labels'])) {
                    $config_list[$key]['mode'] = 1;
                }
                $labels = explode(',', $vo['labels']);
                $config_list[$key]['size'] = count($labels);
                $config_list[$key]['labels'] = json_encode($labels);
            }
        }

        return $config_list;
    }

    // 此方法无用
//    public function getConfigs($group = '', $condition = [])
//    {
//        // 配置分组信息
//        $list_group = sysconf('config_group');
//        $list_group = preg_split('/\s+/', $list_group);
//
//
//        $tab_list = [];
//        foreach ($list_group as $key => $value) {
//            $values = explode(':',$value);
//
//            // 按配置分组查询
//            $condition['group'] = $values[0];
//            // 按分组名称获取配置列表
//            if (!empty($group) && $group == $values[0]) {
//                // 如果分组参数不为空 则按传入的参数查询
//                $setting_list = $this->model->where($condition)->orderBy('sort', 'asc')->get();
//
//                foreach ($setting_list as $lkey=>$vo) {
//
//                    // 如果表单类型是 单选、多选、下拉、联动等类型
//                    if($vo['type'] == 'radio' || $vo['type'] == 'checkbox' || $vo['type'] == 'select' || $vo['type'] == 'linkage' || $vo['type'] == 'linkages' || $vo['type'] == 'switch'){
//                        $options = preg_split('/\s+/', $vo['options']);
//                        $optionsData = [];
//                        foreach ($options as $option){
//                            $optionsValue = explode(':',$option);
//                            $optionsData[$optionsValue[0]] = $optionsValue[1];
//                        }
//
//                        $setting_list[$lkey]['options'] = $optionsData;
//                    }
//
//                    // 如果表单类型是 多选类型 则将value值转换为数组
//                    // TODO 此处有bug
//                    if($vo['type'] == 'checkbox') {
////                        $vo['value'] = explode(':', $vo['value']);
//                        $vo['value'] = explode(',', $vo['value']);
////                        dump($vo['value']);die;
//                    }
//
//                    //如果是图片组类型 将value以|分隔
//                    if ($vo['type'] == 'imagegroup') {
//                        $vo['mode'] = 0;
//                        if (!empty($vo['labels'])) {
//                            $vo['mode'] = 1;
//                        }
//                        $labels = explode(',', $vo['labels']);
//                        $vo['size'] = count($labels);
//                        $vo['labels'] = json_encode($labels);
//                    }
//                }
//                return $setting_list;
//            }
//
//
//            // 获取所有配置
//            $tab_list[$key]['name'] = $values[0];
//            $tab_list[$key]['title'] = $values[1];
//
//            $setting_list = $this->model->where($condition)->orderBy('sort', 'asc')->get();
//
//            foreach ($setting_list as $lkey=>$vo) {
//                // 如果表单类型是 单选、多选、下拉、联动等类型
//                if($vo['type'] == 'radio' || $vo['type'] == 'checkbox' || $vo['type'] == 'select' || $vo['type'] == 'linkage' || $vo['type'] == 'linkages' || $vo['type'] == 'switch'){
//                    $options = preg_split('/\s+/', $vo['options']);
//                    $optionsData = [];
//                    foreach ($options as $option){
//                        $optionsValue = explode(':',$option);
//                        $optionsData[$optionsValue[0]] = $optionsValue[1];
//                    }
//
//                    $setting_list[$lkey]['options'] = $optionsData;
//                }
//
//                // 如果表单类型是 多选类型 则将value值转换为数组
//                if($vo['type'] == 'checkbox') {
//                    $vo['value'] = explode(',', $vo['value']);
//                }
//            }
//        }
//
//        return $tab_list;
//    }

    public function create($data)
    {
        $ret = $this->model->create($data);
        return $ret;
    }

    public function updates($condition, $data)
    {
        $ret = $this->model->where($condition)->update($data);

        if ($ret === false) {
            return false;
        }
        return true;
    }

    public function update_sysconf($data)
    {
        if (empty($data)) {
            return result(-1, null, '设置失败', [], false);
        }

        if (isset($data['id'])) {
//            unset($data['id']);
        }

        // 特殊处理
        if (!empty(request()->post('shippingtime'))) {
            $data['shipping_time'] = request()->post('shippingtime');
        }

        foreach ($data as $key=>$vo) {
            //将数组转换为字符串 TODO 如果是其他配置 怎么做处理？？？
//            if($key == 'wipe_cache_type') {
//                $vo = implode(',', $vo);
//            }
            $config_info = $this->model->where('code', $key)->first();
            if (empty($config_info)) {
                return result(-1, null, '设置失败', [], false);
            }
            if ($config_info->type == 'checkbox' && is_array($vo)) {
                $vo = implode(',', $vo);
            }
//            if ($config_info->type == 'imagegroup' &&  is_array($config_info->value)) {
//                $vo = implode('|', $vo);
//            }
//            dd($vo);

            // 特殊处理
            if ($key == 'use_fee_value') {
                // 平台使用费值 序列化
                $vo = serialize($vo);
            }

            if ($key == 'shipping_time') {
                // 发货时间 json_encode
                if (empty($vo['week'])) {
                    return result(-1, null, '星期不能为空', [], false);
                }
                if (empty($vo['begin_hour'])) {
                    return result(-1, null, '开始时间和结束时间不能为空', [], false);
                }
                $vo = json_encode($vo);
            }

            $result = sysconf($key, $vo);
        }

        if ($result === false) {

            return result(-1, null, '设置失败', [], false);
        }

        return result(0, null, '设置成功', [], false);
    }

    /**
     * 构造查询条件
     *
     * @param $condition
     * @return array
     */
    protected function construct_condition($condition)
    {
        $condition_arr = [];
        if (empty($condition)) {
            return [];
        }
        if (!empty($condition['group'])) {
            $condition_arr[] = ['group', 'like', "%{$condition['group']}%"];
        }
        if (!empty($condition['status'])) {
            $condition_arr[] = ['status', '=', $condition['status']];
        }
        if (!empty($condition['title'])) {
            $condition_arr[] = ['title', 'like', "%{$condition['title']}%"];
        }
        if (!empty($condition['code'])) {
            $condition_arr[] = ['code', 'like', "%{$condition['code']}%"];
        }

        return $condition_arr;
    }
}