<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestAnswer extends Model
{
    protected $table = 'request_answers';
    protected $fillable =['question_id','answer'];

    public function question(){
        return $this->belongsTo(RadiologyQuestion::class,'question_id','id');
    }
    public function patient_request(){
        return $this->hasMany(PatientRequest::class,'request_id','id');
    }
}
