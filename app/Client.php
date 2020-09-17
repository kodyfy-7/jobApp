<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Client extends Authenticatable
{
    use Notifiable;

    protected $guard = 'client';

    protected $fillable = ['name', 'email', 'password', ];

    protected $hidden = ['password', 'remember_token', ];

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
