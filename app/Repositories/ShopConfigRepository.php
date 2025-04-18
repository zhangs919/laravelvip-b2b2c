<?php

namespace App\Repositories;


use App\Models\Shop;
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

    /**
     * 批量插入店铺配置
     * @param object $config 配置信息
     */
    public function batchAdd($config)
    {
        // 全部店铺
        $shops = Shop::select(['shop_id'])->pluck('shop_id');
        $insertData = [];
        foreach ($shops as $shop_id) {
            $insertData[] = [
                'shop_id' => $shop_id,
                'shop_config_id' => $config['id'],
                'config_code' => $config['code'],
                'value' => $config['default_value'],
            ];
        }
        $this->model->addAll($insertData);
    }

    public function createShopConfigData($shop_id)
    {
        // 删除原有数据
        ShopConfig::where('shop_id', $shop_id)->delete();

        $condition[] = ['status', 1];

        $shop_configs = ShopConfigField::select(['id as shop_config_id', 'code as config_code', 'default_value as value'])->where($condition)->orderBy('sort', 'asc')->get();
        $insertData = [];
        foreach ($shop_configs as $config) {
            $insertData[] = [
                'shop_id' => $shop_id,
                'shop_config_id' => $config['shop_config_id'],
                'config_code' => $config['config_code'],
                'value' => $config['value'],
            ];
        }
        $ret = $this->model->addAll($insertData);
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

    public function update_shopconf($data)
    {
        if (empty($data)) {
            return false;
        }

        if (isset($data['id'])) {
//            unset($data['id']);
        }
        foreach ($data as $key => $vo) {
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
                $vo = $vo != '0' ? implode(',', $vo) : [];
            }
//            if ($config_info->type == 'imagegroup' &&  is_array($config_info->value)) {
//                $vo = implode('|', $vo);
//            }
            $result = shopconf($key, $vo);
        }

        if ($result === false) {

            return false;
        }

        return true;
    }

    /**
     * 清空配置值
     *
     * @param string $code code1|code2|code3 ...
     * @param int $shop_id
     * @return array
     */
    public function clear($code, $shop_id)
    {
        if (empty($code)) {
            return result(-1, null, '设置失败', [], false);
        }

        $code = explode('|', $code);
        $ret = ShopConfig::where('shop_id', $shop_id)->whereIn('config_code', $code)->update(['value' => '']);
        if ($ret === false) {
            return result(-1, null, '设置失败', [], false);
        }

        return result(0, null, '设置成功', [], false);
    }

}