<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'user_ref', 'note',
    ];
}
