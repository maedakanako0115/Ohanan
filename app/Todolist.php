<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todolist extends Model
{
    protected $fillable = ['user_id','list_name','assign_personname','deadline','satus'];
    
    const STATUS=[
        0 => [ 'label' => '未着手' ],
        1 => [ 'label' => '着手中' ],
        2 => [ 'label' => '完了' ],
    ];
    public function getStatusLabelAttribute()
    {
        // 状態値
        $satus = $this->attributes['satus'];

        // 定義されていなければ空文字を返す
        if (!isset(self::STATUS[$satus])) {
            return '';
        }

        return self::STATUS[$satus]['label'];
    }
    protected $table='todolists';
}



