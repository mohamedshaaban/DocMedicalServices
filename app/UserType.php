<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    protected $table = 'user_types';
    protected $fillable= ['name'];

    public function users(){
        return $this->hasMany(User::class,'user_type_id','id');
    }

    public function urls(){
        return $this->belongsToMany(Url::class,'user_type_url','user_type_id','url_id');
    }
}
