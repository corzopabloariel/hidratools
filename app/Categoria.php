<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = [
        'order',
        'logo',
        'resume',
        'slug',
        'title',
        'subtitle',
        'image',
        'categoria_id',
        'is_destacado',
        'elim'
    ];
    
    protected $casts = [
        'order'        => 'string',
        'slug'        => 'string',
        'logo'         => 'array',
        'resume'       => 'string',
        'title'        => 'string',
        'subtitle'     => 'string',
        'image'        => 'array',
        'categoria_id' => 'integer',
        'is_destacado' => 'boolean',
        'elim'         => 'boolean',
    ];

    public function categoria()
    {
        return $this->belongsTo('App\Categoria');
    }

    public function categorias()
    {
        return $this->hasMany('App\Categoria' , 'categoria_id' , 'id' );
    }
    
    public function productos()
    {
        return $this->hasMany('App\Producto' , 'categoria_id' , 'id' );
    }
    public function nodo( $n = null )
    {
        if( empty( $n ) ) {
            if( empty( $this->categoria_id ) )
                return $this;
            else
                return nodo( $this->categoria );
        } else {
            if( empty( $n->categoria_id ) )
                return $n;
            else
                return nodo( $n->categoria );
        }
    }
}
