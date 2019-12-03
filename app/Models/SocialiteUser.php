<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class SocialiteUser extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'nick_name', 'avatar', 'email', 'openid', 'access_token', 'login_ip', 'login_times'];
}
