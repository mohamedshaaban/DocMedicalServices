<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RadiologyQuestion extends Model
{
    protected $table = 'radiology_questions';
    protected $fillable =['id','ar_name','en_name','is_for_women'];

    public function answers(){
        return $this->hasMany(RequestAnswer::class,'question_id','id');
    }
}
