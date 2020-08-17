<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventMedia extends Model
{
    protected $fillable = [
        'photo', 'event_id'
    ];

    public function event() {
        return $this->belongsTo('App\Event');
    }
}
