<?php

namespace App\Models;


class Image extends BaseModel
{
    protected $table = 'image';

    protected $fillable = [
        'dir_id', 'dirname', 'extension', 'file_name', 'path', 'name', 'size', 'width', 'height', 'sort','is_delete', 'add_time'
    ];

    protected $primaryKey = 'img_id';

//    public function imageDir()
//    {
//        return $this->belongsTo(ImageDir::class, 'dir_id');
//    }
}
