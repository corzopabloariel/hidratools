<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'order',
        'title',
        'resume',
        'text',
        'category_id',
        'in_home',
        'is_destacado',
        'date',
        'image',
        'elim'
    ];
    
    protected $casts = [
        'order'        => 'string',
        'title'        => 'string',
        'resume'       => 'string',
        'text'         => 'string',
        'category_id'  => 'integer',
        'date'         => 'date',
        'image'        => 'json',
        'elim'         => 'boolean',
        'in_home'      => 'boolean',
        'is_destacado' => 'boolean'
    ];

    public function category()
    {
        return $this->belongsTo('App\Blog_categorias' );
    }
}
