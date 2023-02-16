<?php

namespace App;

use App\Notifications\PasswordResetUserNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    
    ];
    /**
* パスワードリセット通知の送信
*
* @param string $token
* @return void
*/
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetUserNotification($token));    
    }   

    public function comments(){
        return $this->hasMany('App\Comment');
    }
    public function group_infos(){
        return $this->hasMany('App\Group_info');
    }

}
