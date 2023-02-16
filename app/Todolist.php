<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Todolist extends Model
{
    protected $fillable = ['user_id','group_id','list_name','assign_personname','deadline','satus'];
    protected $table='todolists';
}



