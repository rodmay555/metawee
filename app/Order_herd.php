<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_herd extends Model
{

    protected $dates = ['created_at'];

    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }

    public function pay(){
        return $this->hasOne('App\Pay','number_order','number_order');
    }



    public function order_list(){
        return $this->hasMany('App\Order_list','number_order','number_order');
    }

    public function status_na(){
        return $this->hasOne('App\Status','id','status');
    }

    public function delivery(){
        return $this->hasOne('App\Delivery','number_order','number_order');
    }
}
