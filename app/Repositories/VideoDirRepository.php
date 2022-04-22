<?php

// +----------------------------------------------------------------------
// | laravelvip 乐融沃B2B2C商城系统
// +----------------------------------------------------------------------
// | Copyright (c) 2017-2027 http://www.laravelvip.com All rights reserved.
// +----------------------------------------------------------------------
// | Notice: This code is not open source, it is strictly prohibited
// |         to distribute the copy, otherwise it will pursue its
// |         legal responsibility.
// +----------------------------------------------------------------------
// | 版权所有 2015-2027 云南乐融沃网络科技有限公司，并保留所有权利。
// | 网站地址: http://www.laravelvip.com
// +----------------------------------------------------------------------
// | 这不是一个自由软件！禁止拷贝本软件副本，否则将追究其法律责任！
// | 如需使用，请移步官网购买正版授权。
// +----------------------------------------------------------------------
// | Author: 雲溪荏苒 <290648237@qq.com>
// | Date:2019-03-17
// | Description:视频文件夹
// +----------------------------------------------------------------------

namespace App\Repositories;

use App\Models\VideoDir;
use Illuminate\Support\Facades\DB;

class VideoDirRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new VideoDir();
    }

    public function getList($condition = [], $column = '', $isDelete = false)
    {
        $data = $this->model->getList($condition, $column);
        if (!empty($data[0])) {
            foreach ($data[0] as $key=>$value) {
                $where[] = ['dir_id',$value->dir_id];
                if ($isDelete) {
                    // 查询回收站图片
                    $where[] = ['is_delete', 1];
                } else {
                    $where[] = ['is_delete', 0];
                }
                $value->image_count = DB::table('video')->where([['dir_id',$value->dir_id],['is_delete',0]])->count();
            }
        }

        return $data;
    }

    /**
     * 创建默认视频文件夹
     *
     * @param int $shop_id 店铺id
     * @param int $site_id 站点id
     * @param string $dir_group 视频分组 shop店铺视频 site站点视频 backend平台方视频
     * @return mixed
     */
    public function createDefaultDirs($shop_id = 0, $site_id = 0, $dir_group = '')
    {
        $defaultDirs = [
            [
                'shop_id' => $shop_id,
                'site_id' => $site_id,
                'dir_name' => '默认视频',
                'dir_group' => $dir_group,
                'is_default' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'shop_id' => $shop_id,
                'site_id' => $site_id,
                'dir_name' => '默认手机视频',
                'dir_group' => $dir_group,
                'is_default' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'shop_id' => $shop_id,
                'site_id' => $site_id,
                'dir_name' => '默认广告视频',
                'dir_group' => $dir_group,
                'is_default' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'shop_id' => $shop_id,
                'site_id' => $site_id,
                'dir_name' => '默认商品详情视频',
                'dir_group' => $dir_group,
                'is_default' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'shop_id' => $shop_id,
                'site_id' => $site_id,
                'dir_name' => '默认商品视频',
                'dir_group' => $dir_group,
                'is_default' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ],
        ];
        return $this->model->addAll($defaultDirs);
    }

    public function getDirNameById($dir_id)
    {
        $result = $this->model->where('dir_id',$dir_id)->value('dir_name');
        return $result;
    }
}