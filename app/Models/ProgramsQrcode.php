<?php

namespace App\Models;


class ProgramsQrcode extends BaseModel
{
    protected $table = 'programs_qrcode';

    protected $fillable = [
        'shop_id','content','qrcode','img'
    ];

    protected $primaryKey = 'id';
}
