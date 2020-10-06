<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    public function order_herd(){
        return $this->belongsTo('App\Order_herd');
    }

    public function delivery_rate_d(){
        return $this->hasOne('App\Delivery_rate','id','delivery_rate');
    }
}
