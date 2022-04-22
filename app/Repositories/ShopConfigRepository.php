<?php

namespace App\Repositories;



use App\Models\ShopConfig;
use App\Models\ShopConfigField;

class ShopConfigRepository
{

    use BaseRepository;

    protected $model;

    public function __construct()
    {

        $this->model = new ShopConfig();
    }


    public function createShopConfigData($shop_id)
    {
        $condition[] = ['status',1];

        $shop_configs = ShopConfigField::select(['id as shop_config_id','code as config_code','default_value as value'])->where($condition)->orderBy('sort', 'asc')->get();
        $insertData = [];
        foreach ($shop_configs as $config)
        {
            $insertData[] = [
                'shop_id'=>$shop_id,
                'shop_config_id' => $config['shop_config_id'],
                'config_code' => $config['config_code'],
                'value' => $config['value'],
            ];
        }
        $ret = $this->model->addAll($insertData);
        return $ret;
    }

    public function update_shopconf($data)
    {
        if (empty($data)) {
            return false;
        }

        if (isset($data['id'])) {
//            unset($data['id']);
        }
        foreach ($data as $key=>$vo) {
            //将数组转换为字符串 TODO 如果是其他配置 怎么做处理？？？
//            if($key == 'wipe_cache_type') {
//                $vo = implode(',', $vo);
//            }
            $config_info = ShopConfigField::where('code', $key)->first();
//            $config_info = $this->model->where('code', $key)->first();
            if (empty($config_info)) {
                return false;
            }
            if ($config_info->type == 'checkbox') {
                $vo = implode(',', $vo);
            }
//            if ($config_info->type == 'imagegroup' &&  is_array($config_info->value)) {
//                $vo = implode('|', $vo);
//            }
//            dd($vo);
            $result = shopconf($key, $vo);
        }

        if ($result === false) {

            return false;
        }

        return true;
    }


}