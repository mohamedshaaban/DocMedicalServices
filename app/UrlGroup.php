<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UrlGroup extends Model
{
    protected $table = 'url_groups';
    protected $fillable = ['name','href','order'];

    public function urls(){
        return $this->hasMany(Url::class,'url_group_id','id');
    }
}
