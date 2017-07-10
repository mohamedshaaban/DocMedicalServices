<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class servicefiles extends Model
{
    public $timestamps = false;
        protected $table = 'ServiceFiles';
    

    public function services(){
        return $this->belongsTo(services::class,'service_id','id');
    }
}
