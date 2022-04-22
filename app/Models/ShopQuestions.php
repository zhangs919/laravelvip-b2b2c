<?php

namespace App\Models;


class ShopQuestions extends BaseModel
{
    protected $table = 'shop_questions';

    protected $fillable = [
        'shop_id','question','answer','sort'
    ];

    protected $primaryKey = 'questions_id';
}
