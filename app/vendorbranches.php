<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vendorbranches extends Model
{
    public $timestamps = false;
        protected $table = 'VendorBranches';
    

    public function vendor(){
        return $this->belongsTo(vendor::class,'vendor_id','id');
    }
    public function vendorcntacts(){
        return $this->hasMany(vendorcntacts::class,'vendor_branch_id','id');
    }
}
