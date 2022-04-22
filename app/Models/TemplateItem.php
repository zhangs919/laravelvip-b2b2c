<?php

namespace App\Models;


class TemplateItem extends BaseModel
{
    //
    protected $table = 'template_item';

//    protected $primaryKey = 'id';


    protected $fillable = [
        'uid',
        'id',
        'code',
        'data',
        'ext_info',
        'file',
        'is_valid',
        'page',
        'shop_id',
        'site_id',
        'topic_id',
        'sort',
        'tpl_id',
        'tpl_title'
    ];

    /**
     * todo 后期完善 暂时用上面的
     *
     * @var array
     */
//    protected $fillable = [
//        'tpl_id',
//        'data', // 序列化存储数据
//        'uid','shop_id','page','sort','ext_info','tpl_title',
//        'is_valid','site_id','code','topic_id','is_publish',
//        'file', // PC端则存储html app端存储json对象 或者直接读取数据 不用存表
//        'format_is_valid','icon' // 不用存表
//    ];
}
