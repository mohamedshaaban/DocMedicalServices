<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CenterResponse extends Model
{
    protected $table = 'center_responses';
    protected $fillable = ['delivery_est_datetime',
                           'radiology_datetime',
                           'is_at_home',
                           'request_id',

        ];

    public function centers(){
        return $this
            ->belongsToMany(Center::class,'response_centers','response_id','center_id')
            ->withPivot(['arrive_datetime','response_id','center_id'])
            ->withTimestamps();
    }

    public function radiology_types(){
        return $this
            ->belongsToMany(RadiologyType::class,'response_radiology_items','response_id','type_id')
            ->withPivot(['definition','preparation','notes'])
            ->withTimestamps();
    }



    public function patient_request(){
        return $this->belongsTo(PatientRequest::class,'request_id','id');
    }
}
