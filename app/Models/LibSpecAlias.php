<?php

namespace App\Models;


class LibSpecAlias extends BaseModel
{
    protected $table = 'lib_spec_alias';

    /**
     * attr_vid  serialize
     * attr_vnames serialize
     * @var array
     */
    protected $fillable = [
        'goods_id', 'attr_id', 'attr_name'
    ];

    protected $primaryKey = 'id';
}
