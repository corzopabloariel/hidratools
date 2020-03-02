<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog_categorias extends Model
{
    protected $table = "blog_categorias";

    protected $fillable = [
        'order',
        'title',
        'elim'
    ];
    
    protected $casts = [
        'order'    => 'string',
        'title'    => 'string',
        'elim'     => 'boolean',
    ];

    public function blogs()
    {
        return $this->hasMany('App\Blog' , 'category_id' );
    }
}
