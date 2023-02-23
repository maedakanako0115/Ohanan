<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id','diary_id','comment'];
    
    public function diary()
    {
        return $this->belongsTo('App\Diary');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    protected $policies =[
        'App\Comment' => 'App\policies\CommentPolicy',
    ];
}
