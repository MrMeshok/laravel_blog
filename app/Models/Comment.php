<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // public function author() {
    //     return $this->belongsTo('App\User');
    // }
    // public function Author()
    // {
    //     return $this->hasOne('App\Models\User', 'id');
    // }

    public function Author()
    {
        return $this->belongsTo('App\Models\User', 'author_id', 'id');
    }

    public function Profile()
    {
        return $this->belongsTo('App\Models\User', 'profile_id', 'id');
    }

    public function replays(){
       return $this->hasMany('App\Models\Comment' ,'id', 'reply_id');
   }
}
