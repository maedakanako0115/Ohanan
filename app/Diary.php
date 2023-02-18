<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    protected $fillable = ['user_id','group_id','title','date', 'category','image','comment'];
    
    protected $table='diarys';
    
    public function comments(){
        return $this->hasMany('App\Comment');
    }
    public function likes()
    {
      return $this->hasMany('App\Like');
    }
    
}
