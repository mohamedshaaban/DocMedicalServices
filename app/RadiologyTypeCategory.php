<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RadiologyTypeCategory extends Model
{
    protected $table='radiology_type_categories';

    public function radiology_types(){
        return $this->hasMany(RadiologyType::class,'type_group_id','id');
    }
}
