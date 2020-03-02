<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Cliente extends Authenticatable
{
    protected $fillable = [
        'name',
        'username',
        'data',
        'email',
        'password'
    ];
    
    protected $casts = [
        'name'     => 'string',
        'username' => 'string',
        'data'     => 'array',
        'email'    => 'string',
        'password' => 'string'
    ];
}
