<?php

namespace App\Repositories;

use App\Models\AttrValue;
use App\Models\CatAttribute;

class AttrValueRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new AttrValue();
    }


    public function getAttrValueList($cat_id = 0)
    {
        $attr_list = CatAttribute::where([['cat_id', $cat_id], ['is_spec', 0]])
            ->orderBy('sort', 'asc')
//            ->select(['cat_id', 'attr_id', 'is_required','is_show','is_filter','group_name','sort','created_at'])
            ->get();

        $data = [];
        if (!empty($attr_list)) {
            foreach ($attr_list as $item) {
                $attr_values = $item->attr_value;
                $attr_value_list = [];
                if (!empty($attr_values)) {
                    foreach ($attr_values as $av) {
                        $attr_value_list[] = [
                            'id' => $av->attr_vid,
                            'value' => $av->attr_vname
                        ];
                    }
                }
                $data[$item->attr_id] = $attr_value_list;
            }
        }

        return $data;
    }
}