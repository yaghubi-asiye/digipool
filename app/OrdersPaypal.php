<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdersPaypal extends Model
{
    protected $table='orders_paypal';
    public $timestamps = false;
}
