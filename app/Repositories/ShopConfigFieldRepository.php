<?php

namespace App\Repositories;



use App\Models\ShopConfig;
use App\Models\ShopConfigField;
use Illuminate\Support\Facades\DB;

class ShopConfigFieldRepository
{

    use BaseRepository;

    protected $model;

    public function __construct()
    {

        $this->model = new ShopConfigField();
    }

    public function detail($condition)
    {
        $data = $this->model->where($condition)->firstOrFail();
        return $data;
    }

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
     * 商家后台获取特殊的配置项数据
     *
     * @param $group
     * @param string $column
     * @return mixed
     */
    public function getSpecialConfigsByGroup($group, $column = '')
    {
        $condition[] = ['group', $group];
        $condition[] = ['status', 1];
//            $condition[] = ['anchor', $anchor];
        $list = DB::table('shop_config')
            ->join('shop_config_field', 'shop_config.shop_config_id', '=', 'shop_config_field.id')
            ->select('shop_config.value', 'shop_config_field.*')
            ->where($condition)
            ->orderBy('sort', 'asc')
            ->get();

        $list = $this->format_config($list);

        if ($column != '') {//dd(DB::table($this->table));
            // 以某个字段名为键名返回列表
            $newList = [];
            foreach ($list as &$value) {
                $newList[$value->$column] = $value;
            }
            $list = $newList;
//            dd($list);
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

        $list_group = get_shop_config_group();
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
        $group_info = get_shop_config_group($group);
        if ($group_info === false) {
            return false;
        }
        if (!empty($group_info['anchor'])) {
            foreach ($group_info['anchor'] as $anchor) {
                $condition = [];
                $condition[] = ['group', $group];
                $condition[] = ['status', 1];
                $condition[] = ['anchor', $anchor];
                $list = DB::table('shop_config')
                    ->join('shop_config_field', 'shop_config.shop_config_id', '=', 'shop_config_field.id')
                    ->select('shop_config.value', 'shop_config_field.*')
                    ->where($condition)
                    ->orderBy('sort', 'asc')
                    ->get();
//                dd($list);
//                $list = $this->model->where(['group'=>$group,'status'=>1,'anchor'=>$anchor])->orderBy('sort', 'asc')->get();
                $group_info['list'][] = [
                    'anchor' => $anchor,
                    'config_list' => $this->format_config($list)
                ];
            }
        }else {
            $condition[] = ['group', $group];
            $condition[] = ['status', 1];
//            $condition[] = ['anchor', $anchor];
            $list = DB::table('shop_config')
                ->join('shop_config_field', 'shop_config.shop_config_id', '=', 'shop_config_field.id')
                ->select('shop_config.value', 'shop_config_field.*')
                ->where($condition)
                ->orderBy('sort', 'asc')
                ->get();
//            dd($list);
//            $list = $this->model->where(['group'=>$group,'status'=>1])->orderBy('sort', 'asc')->get();
            $group_info['list'] = $this->format_config($list);
        }
        return $group_info;
    }

    private function format_config($config_list)
    {

        $new_array = [];
        foreach ($config_list as $vo) {


//            $vo = (array)$vo;

            // 如果表单类型是 单选、多选、下拉、联动等类型
            if($vo->type == 'radio' || $vo->type == 'checkbox'
                || $vo->type == 'select' || $vo->type == 'linkage' || $vo->type == 'linkages' || $vo->type == 'switch'){
//                dd(preg_split('/\s+/', $vo['options']));
//                $options = preg_split('/\s+/', $vo['options']);
                if (!empty($vo->options)) {
                    $options = explode("\r\n", $vo->options);
                    $optionsData = [];
                    foreach ($options as $option){
                        $optionsValue = explode('::',$option);
                        $optionsData[$optionsValue[0]] = $optionsValue[1];
                    }
                    $vo->options = $optionsData;
                }
            }

            // 如果表单类型是 多选类型 则将value值转换为数组
            // TODO 此处有bug
            if($vo->type == 'checkbox') {
//                        $vo['value'] = explode(':', $vo['value']);
                $vo->value = explode(',', $vo->value);
//                        dump($vo['value']);die;
            }

            //如果是图片组类型 将value以|分隔
            if ($vo->type == 'imagegroup') {
                $vo->mode = 0;
                if (!empty($vo->labels)) {
                    $vo->mode = 1;
                }
                $labels = explode(',', $vo->labels);
                $vo->size = count($labels);
                $vo->labels = json_encode($labels);
            }

//            dd($vo);
            $new_array[$vo->code] = $vo;
        }

        return $new_array;
    }

    /*public function create($data)
    {
        $ret = $this->model->create($data);
        return $ret;
    }*/

    /*public function updates($condition, $data)
    {
        $ret = $this->model->where($condition)->update($data);

        if ($ret === false) {
            return false;
        }
        return true;
    }*/



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