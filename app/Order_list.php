<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_list extends Model
{

    public function order_herd(){
        return $this->belongsTo('App\Order_herd','number_order','number_order');
    }

    public function product(){
        return $this->hasOne('App\Product','id','product_id');
    }
}
