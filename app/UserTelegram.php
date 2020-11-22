<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTelegram extends Model
{
    protected $table='user_telegram';
    protected $fillable = ['step','data'];
}
