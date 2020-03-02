<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = "empresa";

    protected $fillable = [
        'email',
        'phone',
        'domicile',
        'text',
        'social_networks',
        'images',
        'metadata',
        'form',
        'sections',
        'category',
        'schedule',
        'text',
        'captcha'
    ];
    
    protected $casts = [
        'email'           => 'array',
        'phone'           => 'array',
        'domicile'        => 'array',
        'text'            => 'array',
        'social_networks' => 'array',
        'images'          => 'array',
        'metadata'        => 'array',
        'form'            => 'array',
        'sections'        => 'array',
        'schedule'        => 'array',
        'text'            => 'array',
        'category'        => 'array',
        'captcha'         => 'array'
    ];
}
