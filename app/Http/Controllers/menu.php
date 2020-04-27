<?php
/**
 * 
 */
define( 'MENU' ,
[
    [
        'id'        => 'home',
        'nombre'    => 'Home',
        'icono'     => '<i class="fas fa-home"></i>',
        'submenu'   => [
            [
                'nombre'    => 'Slider',
                'icono'     => '<i class="far fa-images"></i>',
                'url'       => route( 'slider.index', [ 'seccion' => 'home' ] )
            ],
            [
                'nombre'    => 'Contenido',
                'icono'     => '<i class="nav-icon fas fa-file-contract"></i>',
                'url'       => route( 'contenido.edit' , [ 'seccion' => 'home' ] )
            ]
        ],
        'ok'        => 1
    ],
    [
        'id'        => 'empresa',
        'nombre'    => 'Empresa',
        'icono'     => '<i class="fas fa-industry"></i>',
        'submenu'   => [
            [
                'nombre'    => 'Slider',
                'icono'     => '<i class="far fa-images"></i>',
                'url'       => route('slider.index', ['seccion' => 'empresa'])
            ],
            [
                'nombre'    => 'Contenido',
                'icono'     => '<i class="nav-icon fas fa-file-contract"></i>',
                'url'       => route( 'contenido.edit' , [ 'seccion' => 'empresa' ] )
            ]
        ],
        'ok'        => 1
    ],
    [
        'id'        => 'productos',
        'nombre'    => 'Productos',
        'icono'     => '<i class="fas fa-hammer"></i>',
        'submenu'   => [
            [
                'nombre'    => 'Categorias',
                'icono'     => '<i class="nav-icon fas fa-file-contract"></i>',
                'url'       => route('categorias.index'),
            ],[
                'nombre'    => 'Productos',
                'icono'     => '<i class="fas fa-pallet"></i>',
                'url'       => route('productos.index')
            ]
        ],
        'ok'        => 1
    ],
    [
        'id'        => 'servicios',
        'nombre'    => 'Servicios',
        'icono'     => '<i class="fas fa-wrench"></i>',
        'url'       => route('servicios.index'),
        'ok'        => 1
    ],
    [
        'id'        => 'videos',
        'nombre'    => 'Videos',
        'icono'     => '<i class="fab fa-youtube"></i>',
        'url'       => route( 'videos.index' ),
        'ok'        => 1
    ],
    [
        'separar' => 1
    ],
    [
        'id'        => 'blog',
        'nombre'    => 'Blog',
        'icono'     => '<i class="fas fa-newspaper"></i>',
        'url'       => route( 'blogs.index' ),
        'ok'        => 1
    ],
    [
        "id"        => "cabeceras",
        "nombre"    => "Cabeceras",
        "icono"     => '<i class="fas fa-image"></i>',
        "url"       => route('cabeceras.index'),
        "ok"        => 1
    ],
    [
        'separar' => 1
    ],
    [
        "id"        => "popup",
        "nombre"    => "Pop up",
        "icono"     => '<i class="fas fa-chalkboard"></i>',
        "url"       => route('popups.index'),
        "ok"        => 1
    ],
    [
        "id"        => "descargas",
        "nombre"    => "Descargas",
        "icono"     => '<i class="fas fa-arrow-alt-circle-down"></i>',
        "url"       => route('descargas.index'),
        "ok"        => 1
    ],
    [
        "id"        => "clientes",
        "nombre"    => "Clientes",
        "icono"     => '<i class="fas fa-users"></i>',
        "url"       => route('clientes.index'),
        "ok"        => 1
    ]
]
);