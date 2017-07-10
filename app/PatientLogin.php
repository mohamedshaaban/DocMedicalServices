<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientLogin extends Model
{
    protected $table = 'patient_login';

    public function patient(){
        return $this->belongsTo(Patient::class,'patient_id','id');
    }
}
