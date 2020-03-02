<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'images',
        'order',
        'title',
        'subtitle',
        'descripcion',
        'manual',
        'ficha',
        'utilidad',
        'caracteristicas',
        'text',
        'planos',
        'accesorios',
        'youtube',
        'categoria_id',
        'is_nuevo',
        'is_destacado',
        'elim'
    ];
    
    protected $casts = [
        'images'          => 'json',
        'order'           => 'string',
        'title'           => 'string',
        'subtitle'        => 'string',
        'descripcion'     => 'string',
        'manual'          => 'json',
        'ficha'           => 'json',
        'utilidad'        => 'string',
        'caracteristicas' => 'json',
        'text'            => 'string',
        'planos'          => 'json',
        'accesorios'      => 'json',
        'youtube'         => 'string',
        'categoria_id'    => 'integer',
        'is_nuevo'        => 'boolean',
        'is_destacado'    => 'boolean',
        'elim'            => 'boolean'
    ];

    public function categoria()
    {
        return $this->belongsTo('App\Categoria' );
    }

    public function full_name()
    {
        $string = "";
        $categoria = $this->categoria;
        $string = "{$categoria->title}";
        if( !empty( $categoria->categoria_id ) ) {
            $categoria_superior = $categoria->categoria;
            $string = "{$categoria_superior->title} / {$string}";
        }
        $string .= " / {$this->title}";

        return $string;
    }
}
