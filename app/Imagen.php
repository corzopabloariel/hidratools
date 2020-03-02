<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    protected $table = "imagenes";
    
    protected $fillable = [
        "image"
    ];
    
    protected $casts = [
        'image' => 'array',
    ];
}
