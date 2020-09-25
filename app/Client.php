<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Client extends Authenticatable
{
    use Notifiable;

    protected $guard = 'client';

    protected $fillable = ['name', 'email', 'password', 'profile_status', 'address', 'city', 'state',  'logo', 'linkedin_link', 'facebook_link', 'twitter_link', ];

    protected $hidden = ['password', 'remember_token', ];

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function profile()
    {
        return $this->hasOne(ClientProfile::class);
    }
}
