<?php

namespace App\Modules\Frontend\Http\Controllers;

use App\Models\CustomFormData;
use App\Models\Form;
use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\CustomFormDataRepository;
use App\Repositories\CustomFormRepository;
use Illuminate\Http\Request;

class CustomFormController extends Frontend
{

    protected $customForm;
    protected $customFormData;

    public function __construct(
        CustomFormRepository $customForm
        ,CustomFormDataRepository $customFormData
    )
    {
        parent::__construct();

        $this->customForm = $customForm;
        $this->customFormData = $customFormData;


    }

    public function show(Request $request, $form_id)
    {
        $form_info = Form::where([['is_publish',1],['form_id',$form_id]])->first();
        if (empty($form_info)) {
            abort(200, '没有可以预览的数据');
        }

        // 如果需要登录 跳转到登录页面
        if ($form_info->need_login && empty($this->user_id)) {
            return redirect('/login.html');
        }

        // 检查表单有效期
        if ($form_info->start_time > 0 && $form_info->end_time > 0 && $form_info->end_time < time()) {
            // 有效期结束时间小于当前时间 则表示表单无效
            abort(200, '表单已经结束！');
        }

        // 检查表单提交次数
        $form_data_count = CustomFormData::where([['user_id',$this->user_id],['form_id',$form_id]])->count();
        if ($form_info->commit_mode == 0 && $form_data_count > 1) {
            // 只允许提交一次
            abort(200, '您已经提交过数据');
        }

        $form_info->form_data = json_decode($form_info->form_data,true);
        $form_info->global_data = json_decode($form_info->global_data,true);

        $form_info = $form_info->toArray();

        // 自定义body样式
        $body_class = 'bg-fixed';
        if ($form_info['global_data']['page_header']['bodybg_type'] == 1) {
            $body_style = "style=background:".$form_info['global_data']['page_header']['bodybg'];
        } else {
            $body_style = "style=background-image:url(\"{$form_info['global_data']['page_header']['bodybg']}\")";
        }
        $seo_title = $form_info['form_title'];
        $compact = compact('seo_title', 'form_info','body_class','body_style');

        return view('custom-form.show', $compact);
    }

    public function add(Request $request)
    {
        $form_id = $request->get('id',0);
        $form_info = Form::where([['is_publish',1],['form_id',$form_id]])->first();
        if (empty($form_info)) {
            return result(-1, null, '没有可以预览的数据');
        }

        // 如果需要登录 跳转到登录页面
        if ($form_info->need_login && empty($this->user_id)) {
            return result(99, null, '需要登录');
        }

        // 检查表单有效期
        if ($form_info->start_time > 0 && $form_info->end_time > 0 && $form_info->end_time < time()) {
            // 有效期结束时间小于当前时间 则表示表单无效
            return result(-1, null, '表单已经结束！');
        }

        // 检查表单提交次数
        $form_data_count = CustomFormData::where([['user_id',$this->user_id],['form_id',$form_id]])->count();
        if ($form_info->commit_mode == 0 && $form_data_count > 1) {
            // 只允许提交一次
            return result(-1, null, '您已经提交过数据');
        }

        if ($form_info->shop_id == $this->user['shop_id']) {
            return result(-1, null, '您不能填写您自己店铺的表单内容');
        }
        /*$form_data_exists = CustomFormData::where([['user_id',$this->user_id],['form_id',$form_id]])->exists();
        if ($form_data_exists) {
            return result(-1,null,'您已经提交过数据');
        }*/

        $post = $request->post();

        // 处理form_data
        $form_data = [];
        $address = $username = $phone = '';
        foreach (json_decode($form_info->form_data,true) as $k=>$v) {
            $item_type = $v['type'].'_'.$k;
            if (isset($post[$item_type])) {
                if ($v['type'] == 'address') {
                    $address = $post[$item_type];
                }
                if ($v['type'] == 'username') {
                    $username = $post[$item_type];
                }
                if ($v['type'] == 'phone') {
                    $phone = $post[$item_type];
                }
                $form_data[] = [
                    'title' => $v['title'],
                    'type' => $item_type,
                    'value' => $post[$item_type]
                ];
            }
        }

        $insert = [
            'form_id' => $form_id,
            'user_id' => $this->user_id,
            'user_name' => $this->user['user_name'],
            'address'=> $address,
            'username'=> $username,
            'phone'=> $phone,
            'add_time' => time(),
            'form_data' => json_encode($form_data),
            'location' => '',
            'ip' => $request->ip(),
        ];
        $ret = $this->customFormData->store($insert);
        Form::where('form_id', $form_id)->increment('fb_num',1); // 反馈数量自增
        if (!$ret) {
            return result(-1, null, '保存失败');
        }
        return result(0,null, '保存成功');
    }

    /**
     * 生成表单二维码
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function formQrcode(Request $request)
    {
        $form_id = $request->get('form_id');
        return $this->customForm->generateFormQrcode($form_id);
    }

}