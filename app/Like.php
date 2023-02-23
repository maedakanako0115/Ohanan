<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['user_id','diary_id',];
    public function diary()
    {
      return $this->belongsTo(Diary::class);
    }
  
    public function user()
    {
      return $this->belongsTo(User::class);
    }
    public function like_exist($id,$diary_id){

        return Like::where('user_id',$id)
        ->where('diary_id',$diary_id)
        ->exists();
    }
}
