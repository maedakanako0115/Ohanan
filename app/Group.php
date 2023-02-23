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
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    protected $policies =[
        'App\Group' => 'App\policies\GroupPolicy',
    ];
}
