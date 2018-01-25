<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // public function gravatar($size = '100')
    // {
    //     $hash = md5(strtolower(trim($this->attributes['email'])));
    //     return "http://www.gravatar.com/avatar/$hash?s=$size";
    // }
}
