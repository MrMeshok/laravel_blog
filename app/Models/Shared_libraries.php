<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shared_libraries extends Model
{
    use HasFactory;

    public function Library()
    {
        return $this->belongsTo('App\Models\User', 'library_id', 'id');
    }

    public function User()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
