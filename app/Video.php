<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'order',
        'url',
        'title',
        'elim'
    ];
    
    protected $casts = [
        'order' => 'string',
        'url'   => 'string',
        'title' => 'string',
        'elim'  => 'boolean',
    ];
}
