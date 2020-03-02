<?php

namespace App\Http\Controllers\PrivateArea;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Page\GeneralController AS gp;

use App\Descarga;
class GeneralController extends Controller
{
    public function __construct()
    {
        if ( !Auth::guard('client')->check() )
            return redirect()->route('index');
    }

    public function descargas()
    {
        $data = (new gp)->datos( "descargas" );
        $data[ "view" ] = "client.descargas";
        $data[ "title" ] = "Descargas";
        $data[ "descargas" ] = [];
        $descargas = Descarga::where( "elim" , 0 )->whereIn( "type" , [ 1 , 2 ])->orderBy( "type" )->orderBy( "order" )->get();
        foreach( $descargas AS $d ) {
            if( !isset( $data[ "descargas" ][ $d->type ] ) )
                $data[ "descargas" ][ $d->type ] = [];
            $data[ "descargas" ][ $d->type ][] = $d;
        }
        return view( 'layouts.main' ,compact( 'data' ) );
    }
    public function mis_datos( Request $request )
    {
        $dataRequest = $request->all();
        if( empty( $dataRequest ) ) {
            $data = (new gp)->datos( "contacto" );
            $data[ "title" ] = "Mis datos";
            $data[ "view" ] = "client.datos";
            $data[ "datos" ] = auth()->guard('client')->user();
    
            return view( 'layouts.main' ,compact( 'data' ) );
        } else {
            $type = $dataRequest[ "type"];
            unset( $dataRequest[ "type"] , $dataRequest[ "_token"] );
            $cliente = auth()->guard('client')->user();
            switch( $type ) {
                case "datos":
                    $cliente->fill( $dataRequest );
                    $cliente->save();
                    return back()->withSuccess(['mssg' => "Datos modificados"]);
                break;
                case "pass":
                    if( Hash::check( $dataRequest[ "password" ], $cliente->password) ) {
                        $cliente->fill( [ "password" => Hash::make( $dataRequest[ "password_new" ] ) ] );
                        $cliente->save();
                        return back()->withSuccess(['mssg' => "Contraseña cambiada"]);
                    } else
                        return back()->withErrors(['mssg' => "La contraseña actual no coincide"]);
                break;
            }
        }
    }
}
