<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RadiologyType extends Model
{
    protected $table='radiology_types';
    protected $fillable = ['en_name','ar_name'];

    public function radiology_type_category(){
        return $this->belongsTo(RadiologyTypeCategory::class,'type_group_id','id');
    }

    public function center_responses(){
        return $this
            ->belongsToMany(CenterResponse::class,'response_radiology_items','type_id','response_id')
            ->withPivot(['price','definition','preparation','notes'])
            ->withTimestamps();
    }
}