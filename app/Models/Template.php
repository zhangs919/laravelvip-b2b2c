<?php

namespace App\Models;


class Template extends BaseModel
{
    //
    protected $table = 'template';

    protected $primaryKey = 'id';


    // todo 模板字段 migration 待更新
    protected $fillable = [
        'code','name','type','type_name','type_code',
        'container','file','icon','is_only','desc','author','version','date','sort','clientRuleCache'
    ];
}
