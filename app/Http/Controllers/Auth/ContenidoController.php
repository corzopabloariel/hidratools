<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contenido;
use App\Empresa;
use App\Slider;
class ContenidoController extends Controller
{
    public function edit( $section ) {
        //dd($section);
        $contenido = Contenido::where( "section" , $section )->first();
        $sliders = Slider::where( 'section' , $section )->where( 'elim' , 0 )->orderBy( 'order' )->get();
        
        $OBJ = [
            "section" => $section,
            "data" => null
        ];

        if( empty( $contenido ) ) {
            $OBJ["data"] = [];
            
            $contenido = Contenido::create( $OBJ );
        }
        //dd($section);
    
        $data = [
            "view" => "auth.parts.contenido" . ucwords( $section ),
            "title" => "Contenido: " . strtoupper( $section ),
            "elementos" => $contenido,
            "section" => $section,
            "sliders" => $sliders,
            "empresa" => Empresa::first()
        ];
        return view( 'auth.distribuidor' , compact( 'data' ) );
    }

    public function update( Request $request , $section ) {
        $datosRequest = $request->all();

        //try {
            $contenido = Contenido::where('section',$section)->first();
            if( empty( $contenido ) ) {
                $contenido = Contenido::create(
                    [
                        "section" => "{$section}",
                        "data" => []
                    ]
                );
            }
            $OBJ = (new AdmController)->object( $request , $contenido[ "data" ] );
            //dd($OBJ);
            $contenido->fill( [ "data" => $OBJ] );
            $contenido->save();
            //dd($contenido);
            echo 1;
        /*} catch (\Throwable $th) {
            return 0;
        }*/
    }
}
