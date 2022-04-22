<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopNode extends Model
{
    //
    protected $table = 'shop_node';

    protected $fillable = [
        'parent_node_id', 'parent_node', 'node_title', 'node_name', 'routes', 'description', 'is_menu', 'is_auth', 'is_default', 'status'
    ];

    protected $primaryKey = 'id';
}
