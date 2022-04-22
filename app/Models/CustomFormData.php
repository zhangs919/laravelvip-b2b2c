<?php

namespace App\Models;


class CustomFormData extends BaseModel
{
    protected $table = 'custom_form_data';

    protected $fillable = [
        'form_id','user_id','user_name','add_time','address','username','phone','form_data','location','ip'
    ];

    protected $primaryKey = 'id';

    public function getFormDataAttribute()
    {
        $form_data = json_decode($this->attributes['form_data'], true);
        if (empty($form_data)) {
            return [];
        }

        return $form_data;
    }
}
