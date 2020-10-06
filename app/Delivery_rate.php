<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery_rate extends Model
{
    public function delivary_d(){
        return $this->hasMany('App\Delivery','delivery_rate','id');
    }
}
