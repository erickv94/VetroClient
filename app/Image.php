<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'public_id', 'url'
    ];

    public $timestamps = false;
}
