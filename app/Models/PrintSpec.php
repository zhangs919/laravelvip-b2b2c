<?php

namespace App\Models;


class PrintSpec extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'print_spec';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shop_id', 'printer', 'print_spec', 'is_default','tpl_data'
    ];

    protected $primaryKey = 'id';


    public function setTplDataAttribute($value)
    {
        $this->attributes['tpl_data'] = json_encode($value);
    }

    public function getTplDataAttribute()
    {
        return $this->attributes['tpl_data'] ?: '{}';
    }
}
