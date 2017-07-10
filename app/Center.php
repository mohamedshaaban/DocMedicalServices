<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    protected $table = 'centers';
    protected $fillable = ['name','address','map_location'];

    public function phones(){
        return $this->hasMany(CenterPhone::class,'center_id','id');
    }

    public function responses(){
        return $this
            ->belongsToMany(CenterResponse::class,'response_centers','center_id','response_id')
            ->withPivot(['arrive_datetime'])
            ->withTimestamps();
    }
}
