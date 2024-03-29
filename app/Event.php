<?php

namespace App;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;
    use Sluggable;

    protected $fillable = [
        'created_by', 'title', 'description',
        'limit', 'location', 'is_pinned',
        'lat', 'lng', 'start_date',
        'end_date'
    ];

    protected $attributes = [
        'is_pinned' => 0
    ];

    public function user() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function images() {
        return $this->hasMany('App\EventMedia');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
