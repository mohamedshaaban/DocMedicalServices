<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vendor extends Model
{
    public $timestamps = false;
        protected $table = 'Vendor';
   
        public function vendorbranches(){
        return $this->hasMany(vendorbranches::class,'vendor_id','id');
        }
 public function vendorcntacts(){
        return $this->hasMany(vendorcntacts::class,'vendor_branch_id','id');
    }
public function vendorservices(){
        return $this->hasMany(vendorservices::class,'vendor_id','id');
    }
}
