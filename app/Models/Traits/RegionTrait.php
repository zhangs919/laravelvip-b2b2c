<?php


namespace App\Models\Traits;


trait RegionTrait
{

    public function getRegionNamesAttribute()
    {
        return get_region_names_by_region_code($this->region_code, ' ');
    }
}