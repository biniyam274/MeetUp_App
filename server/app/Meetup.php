<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meetup extends Model
{
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
