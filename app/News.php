<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['title', 'content' ,'img_preview','img_full','url','type','slid_on'];
}
