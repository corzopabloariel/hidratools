<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Empresa;
use App\Contenido;
class EmpresaController extends Controller
{
    public function datos()
    {
        $datos = Empresa::first();

        if(empty($datos)) {
            $datos = Empresa::create([
                "email" => [],
                "phone" => [],
                "domicile" => [],
                "social_networks" => [],
                "images" => [],
                "metadata" => [],
                "form" => [],
                "sections" => []
            ]);
        }
        
        $data = [
            "title" => "Empresa :: Datos generales",
            "view" => "auth.parts.empresa",
            "seccion" => "empresa",
            "elementos" => $datos
        ];
        return view('auth.distribuidor',compact('data'));
    }

    public function form(Request $request)
    {
        $dataRequest = $request->all();
        $datos = Empresa::first();
        if(empty($dataRequest)) {
            $data = [
                "title"     => "Empresa :: Email de formularios",
                "view"      => "auth.parts.empresaForm",
                "seccion"   => "form",
                "elementos" => $datos
            ];
            return view('auth.distribuidor',compact('data'));
        }
        try {
            unset($dataRequest["_token"]);
            $datos->fill(["form" => $dataRequest]);
            $datos->save();
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
    
    public function update(Request $request)
    {
        $data = Empresa::first();
        //try {
            $OBJ = (new AdmController)->object( $request , $data );
            //dd($OBJ);
            if(is_null($data)) {
                Empresa::create($OBJ);
                echo 1;
            } else {
                $data->fill($OBJ);
                $data->save();
                echo 1;
            }
        /*} catch (\Throwable $th) {
            echo 0;
        }*/
    }
    /**
     * Redes sociales
     */
    public function redes() {
        $datos = Empresa::first()["social_networks"];

        $data = [
            "title"     => "Empresa :: Redes sociales",
            "view"      => "auth.parts.empresaRedes",
            "elementos" => $datos,
            "buttons" => [
                [ "i" => "fas fa-pencil-alt" , "b" => "btn-warning" , "t" => "Editar" ],
                [ "i" => "fas fa-trash-alt" , "b" => "btn-danger" , "t" => "Eliminar" ]
            ],
        ];
        return view('auth.distribuidor',compact('data'));
    }
    public function redesStore(Request $request, $id = null) {
        $datos = Empresa::first();
        try {
            $redes = $datos[ "social_networks" ];
            if( is_null( $id ) )
                $id = time();
            if( empty( $redes ) )
                $redes = [];
            else {
                if( !isset( $redes[ $id ] ) )
                    $redes[ $id ] = [];
            }
            $OBJ = (new AdmController)->object( $request );
            //dd( $OBJ );
            $redes[ $id ] = $OBJ;
    
            $datos->fill([ "social_networks" => $redes ] );
            $datos->save();
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
    public function redesDestroy( Request $request )
    {
        try {
            $data = Empresa::first();
            $redes = $data->social_networks;
            unset( $redes[ $request->all()[ "id" ] ] );
    
            $data->fill( [ "social_networks" => $redes ] );
            $data->save();
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
    public function redesEdit($id)
    {
        return Empresa::first()->social_networks[ $id ];
    }
    public function redesUpdate(Request $request, $id) {
        return self::redesStore($request,$id);
    }
    public function terminos(Request $request) {
        $contenido = Contenido::where( "section" , "terminos")->first();
        if( empty( $contenido ) )
            $contenido = Contenido::create( [ "section" => "terminos" , "data" => [ "titulo" => null , "texto" => null ] ] );
        $data = [
            "title"     => "Contenido: TÉRMINOS Y CONDICIONES",
            "view"      => "auth.parts.contenidoTerminos",
            "section"   => "terminos",
            "elementos" => $contenido
        ];
        return view( 'auth.distribuidor' , compact( 'data' ) );
    }
}
