<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use SoftDeletes;

    protected $fillable = ['client_id', 'category_id', 'job_title', 'job_description', 'job_deadline', 'job_status', 'job_slug'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function getRouteKeyName()
    {
        return 'job_slug';
    }
}
