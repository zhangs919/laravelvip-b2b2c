<?php

namespace App\Models;


class CustomFormTemplate extends BaseModel
{
    protected $table = 'custom_form_template';

    protected $fillable = [
        'group','code','preview_image','thumb_image','title','form_datas','global_form_datas'
    ];

    protected $primaryKey = 'id';


    /*public function getFormDatasAttribute()
    {
        $form_datas = json_decode($this->attributes['form_datas'], true);
        if (empty($form_datas)) {
            return [];
        }

        return $form_datas;
    }

    public function getGlobalFormDatasAttribute()
    {
        $global_form_datas = json_decode($this->attributes['global_form_datas'], true);
        if (empty($global_form_datas)) {
            return [];
        }

        return $global_form_datas;
    }*/
}
