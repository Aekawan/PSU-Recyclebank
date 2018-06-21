<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['user_id', 'garbage_id' ,'purchase_price','unit','sale_price', 'profit', 'loss','dateofsale'];

    public function user()
    {
        return $this->belongsTo('User','user_id');
    }
     public function garbage()
    {
        return $this->belongsTo('Garbage','garbage_id');
    }
}
