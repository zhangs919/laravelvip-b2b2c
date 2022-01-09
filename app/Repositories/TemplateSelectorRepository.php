<?php

namespace App\Repositories;


use App\Models\TemplateSelector;


class TemplateSelectorRepository extends TemplateSelector
{



    public function detail($condition)
    {
        $data = TemplateSelector::where($condition)->first();
        return $data;
    }
}