<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $fillable = ['post_id', 'user_id', 'content'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }


}
