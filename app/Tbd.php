<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbd extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'user_ref', 'tbd',
    ];
}
