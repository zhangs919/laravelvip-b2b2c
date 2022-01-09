<?php

namespace App\Repositories;

use App\Models\ImageDir;
use Illuminate\Support\Facades\DB;

class ImageDirRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new ImageDir();
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
                $value->image_count = DB::table('image')->where([['dir_id',$value->dir_id],['is_delete',0]])->count();
            }
        }

        return $data;
    }

    /**
     * 创建默认相册
     *
     * @param int $shop_id 店铺id
     * @param int $site_id 站点id
     * @param string $dir_group 相册分组 shop店铺相册 site站点相册 backend平台方相册
     * @return mixed
     */
    public function createDefaultDirs($shop_id = 0, $site_id = 0, $dir_group)
    {
        $defaultDirs = [
            [
                'shop_id' => $shop_id,
                'site_id' => $site_id,
                'dir_name' => '默认相册',
                'dir_group' => $dir_group,
                'is_default' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'shop_id' => $shop_id,
                'site_id' => $site_id,
                'dir_name' => '默认手机相册',
                'dir_group' => $dir_group,
                'is_default' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'shop_id' => $shop_id,
                'site_id' => $site_id,
                'dir_name' => '默认广告相册',
                'dir_group' => $dir_group,
                'is_default' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'shop_id' => $shop_id,
                'site_id' => $site_id,
                'dir_name' => '默认商品详情相册',
                'dir_group' => $dir_group,
                'is_default' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'shop_id' => $shop_id,
                'site_id' => $site_id,
                'dir_name' => '默认商品相册',
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