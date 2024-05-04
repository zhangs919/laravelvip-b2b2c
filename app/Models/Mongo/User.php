<?php

namespace App\Models\Mongo;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;


class User extends Eloquent
{
    use SoftDeletes;
    protected $connection = 'mongodb';  //库名
    protected $collection = 'user';    //文档名
    protected $primaryKey = '_id';    //设置id
    protected $fillable = ['user_name', 'nickname'];  //设置字段白名单
    protected $dates = ['deleted_at'];
}