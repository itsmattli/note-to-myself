<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'user_ref', 'link',
    ];
}
