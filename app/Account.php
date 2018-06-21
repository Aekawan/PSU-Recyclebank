<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
  protected $fillable = [
    'user_id','garbage_id','purchase_price','unit','deposit','withdraw','balance',
  ];

}
