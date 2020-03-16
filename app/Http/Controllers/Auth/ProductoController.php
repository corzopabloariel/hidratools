<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;

use App\Categoria;
use App\Producto;
class ProductoController extends Controller
{
    public $model;
    public function __construct() {
        $this->model = new Producto;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        /*$aaa = $this->model->all();
        foreach($aaa AS $a) {
            $a->fill([
                "slug" => str_slug($a->title)
            ]);
            $a->save();
        }*/
        $dataRequest = $request->all();
        $data = [];
        $data[ "view" ] = "auth.parts.producto";
        $elementos = $this->model::where( 'elim',0 )->orderBy('order')->paginate( 15 );
        if( !empty( $dataRequest ) ) {
            if( !isset( $dataRequest[ "page"] ) ) {
                if( isset( $dataRequest[ "search"] ) ) {
                    $elementos = $this->model::where( 'elim',0 )->whereRaw( "UPPER(CONCAT_WS( ' ' ,`title`, `subtitle`, `descripcion`, `utilidad`, `caracteristicas`, `text`, `accesorios` )) LIKE UPPER('%{$dataRequest[ "search" ]}%')" )->orderBy('order')->paginate( 15 );
                    $data[ "search" ] = $dataRequest[ "search"];
                } else {
                    self::store( $request );
                    die();
                }
            }
        }
        $categorias = Categoria::where( "elim" , 0 )->orderBy( "order" )->whereNull( "categoria_id" )->get();
        $data[ "categorias" ] = [];
        foreach( $categorias AS $c ) {
            $aux = $c->categorias()->where( "elim" , 0 )->orderBy( "order" )->pluck( "title" , "id" );
            if( $aux->isNotEmpty() ) {
                foreach( $aux AS $v => $k )
                    $data[ "categorias" ][ $v ] = "{$c->title}, {$k}";
            } else
                $data[ "categorias" ][ $c->id ] = "{$c->title}";
        }
        $data[ "title" ] = "Productos";
        $data[ "elementos" ] = $elementos;
        $data[ "buttons" ] = [
            [ "i" => "fas fa-pencil-alt" , "b" => "btn-warning" , "t" => "Editar" ],
            [ "i" => "fas fa-trash-alt" , "b" => "btn-danger" , "t" => "Eliminar" ]
        ];
        return view('auth.distribuidor',compact('data'));
    }

    public function show() {}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $data = null)
    {
        //try {
            $OBJ = (new AdmController)->object( $request , $data );
            if( !isset( $request->all()[ "producto_planos_planos" ] ) ) {
                if( !isset( $OBJ[ "planos" ] ) )
                    $OBJ[ "planos" ] = null;
            }
            if( !isset( $OBJ[ "caracteristicas" ] ) )
                $OBJ[ "caracteristicas" ] = null;
            //dd($OBJ);
            if(is_null($data)) {
                $this->model::create($OBJ);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->model::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = self::edit($id);
        return self::store($request,$data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            (new AdmController)->delete( self::edit( $request->all()[ "id" ] ) , $this->model->getFillable() );
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
}
