<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vendoruploads extends Model
{
    public $timestamps = false;
        protected $table = 'VendorUploads';
    

    public function vendorservices(){
        return $this->belongsTo(vendorservices::class,'vendorservices_id','id');
    }
}
