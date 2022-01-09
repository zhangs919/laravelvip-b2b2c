<?php

namespace App\Models;


class SpecAlias extends BaseModel
{
    protected $table = 'spec_alias';

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
