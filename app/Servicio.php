<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $fillable = [
        'order',
        'text',
        'resume',
        'title',
        'image',
        'youtube',
        'elim'
    ];
    
    protected $casts = [
        'image' => 'array',
    ];
}
