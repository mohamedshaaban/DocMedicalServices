<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vendorservices extends Model
{
    public $timestamps = false;
        protected $table = 'VendorServices';
    

    public function vendor(){
        return $this->belongsTo(vendor::class,'vendor_id','id');
    }
     public function services(){
        return $this->belongsTo(services::class,'service_id','id');
    }  
    public function vendoruploads()
    {
        return $this->hasMany(vendoruploads::class,'vendorservices_id','id');
    }
}
