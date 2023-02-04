<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group_info extends Model
{
    protected $fillable = ['user_id','diary_id','name'];
    
}
