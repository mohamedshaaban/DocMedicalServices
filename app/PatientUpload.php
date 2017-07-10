<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientUpload extends Model
{
    protected $table='patient_uploads';
    protected $fillable = ['image_url'];

    public function patient_request(){
        return $this->belongsTo(PatientRequest::class,'patient_id','id');
    }
}
