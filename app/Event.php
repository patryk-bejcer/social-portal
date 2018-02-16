<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	protected $fillable = ['user_id', 'title', 'place', 'start_date', 'end_date', 'visibility', 'description', 'website', 'event_img'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function attendance()
    {
        return $this->hasMany('App\EventAttendance');
    }

}
