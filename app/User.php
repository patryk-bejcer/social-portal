<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Phone;

/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'sex', 'avatar', 'phone', 'city', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function friendsOfOther()
    {
        return $this->belongsToMany('App\User', 'friends', 'user_id', 'friend_id')
            ->wherePivot('accepted', 1);
    }

    public function friendsOfMine()
    {
        return $this->belongsToMany('App\User', 'friends', 'friend_id', 'user_id')
            ->wherePivot('accepted', 1);
    }

    public function friends()
    {
        return $this->friendsOfOther->merge($this->friendsOfMine);
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }


}
