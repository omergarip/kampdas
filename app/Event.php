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
        'limit' => 0,
        'is_pinned' => 0
    ];

    public function user() {
        return $this->belongsTo(User::class);
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
