<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FreightFreeRecord extends Model
{
    protected $table = 'freight_free_record';

    protected $fillable = [
        'freight_id','is_default','region_codes','region_names','region_path','free_money','free_mode','free_number','add_time'
    ];

    protected $primaryKey = 'record_id';
}
