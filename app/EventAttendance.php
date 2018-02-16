<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventAttendance extends Model
{
    protected $fillable = [

        'event_id', 'user_id', 'status',

    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
