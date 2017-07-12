<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class servicefiles extends Model
{
    
        protected $table = 'ServiceFiles';
    

    public function services(){
        return $this->belongsTo(services::class,'service_id','id');
    }
}
