<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vendorcntacts extends Model
{
    //
    
    
   protected $table = 'VendorContacts';
    

    public function vendorbranches(){
        return $this->belongsTo(vendorbranches::class,'vendor_branch_id','id');
    }
}
