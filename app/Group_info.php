<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group_info extends Model
{
    protected $table = 'group_infos';
    protected $fillable = ['user_id','diary_id','group_id','name'];
    
    public function group()
        {
            return $this->belongsTo('App\Group');
        }
        public function user()
        {
            return $this->belongsTo('App\User');
        }
}
