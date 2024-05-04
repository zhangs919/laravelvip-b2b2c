<?php

namespace App\Models;


class AdminNode extends BaseModel
{
    //
    protected $table = 'admin_node';

    protected $fillable = [
        'parent_node_id', 'parent_node', 'node_title', 'node_name', 'routes', 'description', 'is_menu', 'is_auth', 'is_show',
        'sort'
    ];

    protected $primaryKey = 'id';

}
