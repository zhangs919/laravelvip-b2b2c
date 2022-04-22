<?php

namespace App\Models;


class TemplateCat extends BaseModel
{
    //
    protected $table = 'template_cat';

    protected $primaryKey = 'id';


    protected $fillable = [
        'tpl_code', 'selector_type', 'cat_id', 'number', 'width', 'height'
    ];
}
