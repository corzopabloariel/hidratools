<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Contenido;
class CabecerasController extends Controller
{
    public function index() {
        $data = [
            "view"      => "auth.parts.cabecera",
            "title"     => "Cabeceras de secciones",
            "cabeceras" => [
                "header_contacto" => "Contacto",
                "header_videos" => "Videos",
                "header_blogs" => "Blogs",
                "header_servicios" => "Servicios",
                "header_productos" => "Productos",
                "header_presupuesto" => "Presupuesto",
                "header_descargas" => "Descargas"
            ],
            "contenido" => []
        ];

        foreach( $data[ "cabeceras" ] AS $k => $v )
            $data[ "contenido" ][ $k ] = Contenido::where( "section" , $k )->first();
        
        return view('auth.distribuidor',compact('data'));
    }
}