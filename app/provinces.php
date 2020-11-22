<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class provinces extends Model
{
    public function cities()
    {
        return $this->hasMany('App\cities','parent');
    }
}
