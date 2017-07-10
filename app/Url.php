<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $table = 'urls';
    protected $fillable =['name','href','order','url_group_id'];

    public function url_group(){
        return $this->belongsTo(UrlGroup::class,'url_group_id','id');
    }

    public function user_types(){
        return $this->belongsToMany(UserType::class,'user_type_url','url_id','user_type_id');
    }
}
