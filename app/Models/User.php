<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // 批量赋值
    protected $fillable = ['name', 'email', 'password'];

    // 查询成功后自动过滤敏感字段信息
    protected $hidden = ['password', 'remember_token'];

    // 属性转换
    protected $casts = ['email_verified_at' => 'datetime'];
}
