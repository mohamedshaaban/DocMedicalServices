<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class services extends Model
{
    
        protected $table = 'Services';
    
   public function servicefiles(){
        return $this->hasMany(servicefiles::class,'service_id','id');
    }
    public function vendorservices(){
        return $this->hasMany(vendorservices::class,'service_id','id');
    }
   
}
