<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CenterPhone extends Model
{
    protected $table = 'center_phones';
    protected $fillable = ['phone'];

    public function center(){
        return $this->belongsTo(Center::class,'center_id','id');
    }
}
