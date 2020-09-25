<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientProfile extends Model
{
    protected $fillable = ['user_id', 'logo', 'linkedin_link', 'facebook_link', 'twitter_link', ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
