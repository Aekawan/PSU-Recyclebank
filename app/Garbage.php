<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Garbage extends Model
{
    protected $fillable = ['type', 'purchase_price','detail'];

    public function account()
    {
        return $this->hasMany('Account','garbage_id','id');
    }
}
