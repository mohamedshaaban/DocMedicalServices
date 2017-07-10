<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientAddress extends Model
{
    protected $table='patient_addresses';

    public function patient(){
        return $this->belongsTo(Patient::class,'patient_id','id');
    }

    public function country(){
        return $this->belongsTo(Country::class,'country_code','country_code');
    }
}
