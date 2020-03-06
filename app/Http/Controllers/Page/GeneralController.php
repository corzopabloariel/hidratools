<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Contenido;
use App\Slider;
use App\Empresa;
use App\Video;
use App\Blog;
use App\Blog_categorias;
use App\Servicio;
use App\Categoria;
use App\Producto;
use App\Descarga;
class GeneralController extends Controller
{
    public function __construct() {}

    public function datos( $link = null ) {
        $datos = Empresa::first();
        $whatsapp = $telefono = $telefonoHeader = [];
        if( empty( $link ) )
            $link = "home";
        
        for( $i = 0 ; $i < count( $datos->phone ) ; $i++ ) {
            if( $datos->phone[ $i ][ "tipo" ] == "wha" )
                $whatsapp[] = $datos->phone[ $i ];
            else
                $telefono[] = $datos->phone[ $i ];
        }
        $data = [
            "empresa" => $datos,
            "whatsapp" => $whatsapp,
            "telefono" => $telefono,
            "telefonoHeader" => $telefonoHeader,
            "contenido" => Contenido::where( "section" , $link )->first(),
            "cabecera" => Contenido::where( "section" , "header_{$link}" )->first(),
            "slider" => Slider::where( "section" , $link )->where( "elim" , 0 )->orderBy( "order" )->get(),
            "terminos" => Contenido::where( "section" , "terminos" )->first(),
            "metadato" => [
                "description" => "",
                "keywords" => ""
            ],
            "descarga_publica" => Descarga::where( "type" , 0 )->where( "elim" , 0 )->get(),
            "title" => isset( $datos->sections[ $link ] ) ? $datos->sections[ $link ][ "NAME" ] : $datos->sections[ "home" ][ "NAME" ]
        ];
        if( isset( $datos->metadata[ $link ] ) )
            $data[ "metadato" ] = $datos->metadata[ $link ];
        return $data;
    }

    public function index( $link = null ) {
        $data = self::datos( $link );
        if( empty( $link ) )
            $link = "home";
        $data[ "view" ] = "page.{$link}";
        switch( $link ) {
            case "home":
                $data[ "categorias" ] = Categoria::where( "elim" , 0 )->whereNull( "categoria_id" )->orderBy( "order" )->get();
                $data[ "blogs" ] = Blog::where( "elim" , 0 )->where( "in_home" , 1 )->orderBy( "order" )->take( 3 )->get();
                $data[ "productos" ] = Producto::where( "elim" , 0 )->where( "is_destacado" , 1 )->orderBy( "order" )->orderByRaw('RAND()')->get();
                $data[ "categoriasD" ] = Categoria::where( "elim" , 0 )->where( "is_destacado" , 1 )->orderBy( "order" )->orderByRaw('RAND()')->get();
                //$data[ "familias" ] = Familia::where( "elim" , 0 )->whereNull( "familia_id" )->whereNotNull( "image" )->orderBy( "order" )->get();
            break;
            case "videos":
                $data[ "videos" ] = Video::where( "elim" , 0 )->orderBy( "order" )->get();
            break;
            case "blogs":
                $data[ "blogs_destacado" ] = Blog::where( "elim" , 0 )->where( "is_destacado" , 1 )->orderBy( "order" )->take( 3 )->get();
                $data[ "blogs" ] = Blog::where( "elim" , 0 )->whereNull( "is_destacado" )->orderBy( "date" , "DESC" )->simplePaginate( 8 );
                $data[ "blog_categorias" ] = Blog_categorias::where( "elim" , 0 )->get( );
                $data[ "videos" ] = Video::where( "elim" , 0 )->orderBy( "order" )->take( 3 )->get();
            break;
            case "servicios":
                $data[ "servicios" ] = Servicio::where( 'elim',0 )->orderBy( 'order' )->paginate( 15 );
            break;
            case "productos":
                $data[ "categorias" ] = Categoria::where( "elim" , 0 )->whereNull( "categoria_id" )->orderBy( "order" )->get();
            break;
        }

        return view( 'layouts.main' ,compact( 'data' ) );
    }

    public function consulta2( $title , $id ) {
        $data = self::datos( "contacto" );
        $data[ "servicio" ] = Servicio::find( $id );
        $data[ "view" ] = "page.contacto";
        $data[ "title" ] = "Consulta del servicio {$data["servicio"]->title}";

        return view( 'layouts.main' ,compact( 'data' ) );
    }

    public function consulta( $title , $id , $index = null , $name = null ) {
        $data = self::datos( "contacto" );
        $data[ "producto" ] = Producto::find( $id );
        $data[ "index" ] = $index;
        $data[ "name" ] = $name;
        $data[ "view" ] = "page.contacto";
        $data[ "title" ] = "Consulta del producto {$data["producto"]->title}";

        return view( 'layouts.main' ,compact( 'data' ) );
    }

    public function producto( $title , $id ) {
        $data = self::datos( "productos" );
        $data[ "producto" ] = Producto::find( $id );
        $data[ "subcategoria" ] = $data[ "producto" ]->categoria;
        $data[ "categoria" ] = $data[ "subcategoria" ]->categoria;
        $data[ "view" ] = "page.producto";
        $data[ "categorias" ] = Categoria::where( "elim" , 0 )->whereNull( "categoria_id" )->orderBy( "order" )->get();
        $data[ "cabecera" ] = Contenido::where( "section" , "header_productos" )->first();
        $data[ "title" ] = "Producto - {$data["producto"]->title}";
        return view( 'layouts.main' ,compact( 'data' ) );
    }

    public function subcategoria( $ntitle , $nid , $title , $id ) {
        $data = self::datos( "productos" );
        $data[ "subcategoria" ] = Categoria::find( $id );
        $data[ "categoria" ] = $data[ "subcategoria" ]->categoria;
        $aux = $data[ "subcategoria" ]->productos()->where( "elim" , 0 );
        if( $aux->count() == 1 ) {
            $aux = $aux->first();
            if( $aux->title == $data[ "subcategoria" ]->title )
                return self::producto( null , $aux->id );
        }
        $data[ "view" ] = "page.subcategoria";
        $data[ "categorias" ] = Categoria::where( "elim" , 0 )->whereNull( "categoria_id" )->orderBy( "order" )->get();
        $data[ "productos" ] = $data[ "subcategoria" ]->productos()->where( "elim" , 0 )->orderBy( "order" )->paginate( 15 );
        $data[ "cabecera" ] = Contenido::where( "section" , "header_productos" )->first();
        $data[ "title" ] = "Productos - {$data["categoria"]->title} / {$data["subcategoria"]->title}";
        return view( 'layouts.main' ,compact( 'data' ) );
    }

    public function categoria( $title , $id ) {
        $data = self::datos( "productos" );
        $data[ "categoria" ] = Categoria::find( $id );
        $data[ "view" ] = "page.categoria";
        $data[ "categorias" ] = Categoria::where( "elim" , 0 )->whereNull( "categoria_id" )->orderBy( "order" )->get();
        $data[ "subcategorias" ] = $data[ "categoria" ]->categorias()->where( "elim" , 0 )->orderBy( "order" )->paginate( 15 );
        $data[ "cabecera" ] = Contenido::where( "section" , "header_productos" )->first();
        $data[ "title" ] = "Productos - {$data["categoria"]->title}";
        return view( 'layouts.main' ,compact( 'data' ) );
    }

    public function servicio( $title , $id ) {
        $data = self::datos( "servicios" );
        $data[ "servicio" ] = Servicio::find( $id );
        $data[ "view" ] = "page.servicio";
        $data[ "cabecera" ] = Contenido::where( "section" , "header_servicios" )->first();
        $data[ "title" ] = "Servicio - {$data["servicio"]->title}";
        return view( 'layouts.main' ,compact( 'data' ) );
    }

    public function blog( $title , $id ) {
        $data = self::datos( "blogs" );
        $data[ "blog" ] = Blog::find( $id );
        $data[ "previous" ] = Blog::where( "id" , "<" , $id )->orderBy( "date" )->first();
        $data[ "next" ] = Blog::where( "id" , ">" , $id )->orderBy( "date" , "DESC" )->first();
        $data[ "blog_categorias" ] = Blog_categorias::where( "elim" , 0 )->get( );
        $data[ "videos" ] = Video::where( "elim" , 0 )->orderBy( "order" )->take( 3 )->get();
        $data[ "view" ] = "page.blog";
        $data[ "cabecera" ] = Contenido::where( "section" , "header_blogs" )->first();
        $data[ "title" ] = "Blog - {$data["blog"]->title}";
        return view( 'layouts.main' ,compact( 'data' ) );
    }

    public function blog_category( $slug_category , $id ) {
        $data = self::datos( "blogs" );
        $data[ "category" ] = Blog_categorias::find( $id );
        $data[ "blog_categorias" ] = Blog_categorias::where( "elim" , 0 )->get( );
        $data[ "videos" ] = Video::where( "elim" , 0 )->orderBy( "order" )->take( 3 )->get();
        $data[ "view" ] = "page.blog_category";
        $data[ "blogs" ] = $data[ "category" ]->blogs()->where( "elim" , 0 )->orderBy( "date" , "DESC" )->simplePaginate( 8 );
        $data[ "cabecera" ] = Contenido::where( "section" , "header_blogs" )->first();
        $data[ "title" ] = "Categoría - {$data[ "category" ]->title}";
        return view( 'layouts.main' ,compact( 'data' ) );
    }
}
