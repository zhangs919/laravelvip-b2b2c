<?php

namespace App\Models;


class AttrValue extends BaseModel
{
    protected $table = 'attr_value';

    protected $fillable = [
        'attr_id', 'attr_vname', 'attr_vsort'/*, 'is_delete'*/
    ];

    protected $primaryKey = 'attr_vid';
}
