<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

   protected $table='users';
    protected $fillable = [
        'id', 'id_level', 'name', 'email', 'phone', 'address', 'password',
    ];

    
    protected $hidden = [
        'password', 'remember_token',
    ];

    public $timestamps = true;
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
