<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Descarga extends Model
{
    protected $fillable = [
        "order",
        "type",
        "name",
        "image",
        "file",
        "elim"
    ];
    
    protected $casts = [
        'order' => 'integer',
        'type'  => 'integer',
        'name'  => 'string',
        'image' => 'json',
        'file'  => 'json',
        'elim'  => 'boolean'
    ];
}
