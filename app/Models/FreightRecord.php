<?php

namespace App\Models;


class FreightRecord extends BaseModel
{
    protected $table = 'freight_record';

    protected $fillable = [
        'freight_id','is_default','region_codes','region_names','region_path','region_desc','region_color','start_num','start_money',
        'plus_num','plus_money','is_cash','cash_more','sort','add_time','last_time'
    ];

    protected $primaryKey = 'record_id';
}
