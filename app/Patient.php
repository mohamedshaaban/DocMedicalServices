<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table='patient';

    protected $hidden = ['password'];

    public function addresses(){
        return $this->hasMany(PatientAddress::class,'patient_id','id');
    }

    public function logins(){
        return $this->hasMany(PatientLogin::class,'patient_id','id');
    }

    public function patient_requests(){
        return $this->hasMany(PatientRequest::class,'patient_id','id');
    }

}
