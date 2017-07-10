<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientRequest extends Model
{
    protected $table= 'patient_requests';

    protected $fillable = [
        'patient_id',
        'patient_name',
        'patient_age',
        'patient_weight',
        'patient_address_id',
        'is_at_home',
        'is_able_to_be_stable',
        'number_of_scanned_prescriptions',
        'status',
        'refuse_comment'
    ];
    public function patient(){
        return $this->belongsTo(Patient::class,'patient_id','id');
    }

    public function request_uploads(){
        return $this->hasMany(PatientUpload::class,'request_id','id');
    }

    public function center_response(){
        return $this->hasOne(CenterResponse::class,'request_id','id');
    }

    public function answers(){
        return $this->hasMany(RequestAnswer::class,'request_id','id');
    }
}
