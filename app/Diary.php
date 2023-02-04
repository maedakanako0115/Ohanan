<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    protected $fillable = ['user_id','title','date', 'category','image','comment'];
    protected $table='diarys';
    
}
