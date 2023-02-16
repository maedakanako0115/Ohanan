<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name','group_token','user_id'];

    public function comments(){
        return $this->hasMany('App\Comment');
    }
    public function group_infos(){
        return $this->hasMany('App\Group_info');
    }
}
