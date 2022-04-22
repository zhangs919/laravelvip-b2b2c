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
// | Date:2019-03-14
// | Description:万能表单数据
// +----------------------------------------------------------------------

namespace App\Repositories;

use App\Models\CustomFormData;
use App\Models\Form;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CustomFormRepository
{
    use BaseRepository;

    protected $model;



    public function __construct()
    {
        $this->model = new Form();
    }

    /**
     * 生成表单二维码
     *
     * @param $form_id
     * @return \Illuminate\Http\Response
     */
    public function generateFormQrcode($form_id)
    {
        $url = route('show_form', ['form_id'=>$form_id]);

        $qrCode = QrCode::errorCorrection('L')
            ->format('png')
            ->size(347)
//            ->merge('/public/qrcodes/water.png',.15) // 合并水印图片到二维码
            ->margin(0)
//            ->color(255,0,255)
//            ->backgroundColor(125,245,0)
            ->encoding('UTF-8')
            ->generate($url);
        return response()->make($qrCode, 200, ['Content-Type' => 'image/png']);
    }

    /**
     * 批量删除表单
     * 关联删除表单数据
     *
     * @param $id
     * @return bool
     */
    public function del($id)
    {
        DB::beginTransaction();
        try {
            // 1.删除表单
            $this->model->del($id);

            // 2.删除表单数据
            CustomFormData::where('form_id',$id)->delete();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();//事务回滚
            echo $e->getMessage();
            echo $e->getCode();
            return false;
        }
    }

    /**
     * 批量删除表单
     * 关联删除表单数据
     *
     * @param $ids
     * @return bool
     */
    public function batchDel($ids)
    {
        DB::beginTransaction();
        try {
            unset($ids['on']); // 移除无用元素

            // 1.删除表单
            $this->model->batchDel($ids);

            // 2.删除表单数据
            CustomFormData::whereIn('form_id',$ids)->delete();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();//事务回滚
            echo $e->getMessage();
            echo $e->getCode();
            return false;
        }
    }
}