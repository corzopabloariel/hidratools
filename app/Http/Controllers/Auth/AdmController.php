<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imagen;
class AdmController extends Controller
{
    public $acceptedFormats = [ 'gif' , 'png' ,'jpg' , 'pdf' , 'bmp' , 'svg' , 'txt' , 'xls' , 'dbf' ];
    public $model;
    public function __construct() {
        $this->model = new Imagen;
    }
    public function index() {
        $data = [
            "title" => "Administración",
            "view" => "auth.parts.index",
            "SIN" => 1
        ];
        return view( 'auth.distribuidor' ,compact( 'data' ) );
    }
    /** */
    public function logout() {
        Auth::logout();
    	return redirect()->to('/adm');
    }
    
    public function imagen( Request $request ) {
        set_time_limit(0);
        $dataRequest = $request->all();
        if( empty( $dataRequest ) ) {
            $data = [
                "view"      => "auth.parts.imagen",
                "title"     => "Imágenes",
                "elementos"  => Imagen::get(),
                "buttons" => [
                    [ "i" => "fas fa-trash-alt" , "b" => "btn-danger" , "t" => "Eliminar" ]
                ],
            ];
            return view('auth.distribuidor',compact('data'));
        }
    }
    public function imagenStore(Request $request, $data = null) {
        //try {
            $OBJ = self::object( $request , $data );
            //dd( $OBJ );
            if(is_null($data)) {
                $this->model::create($OBJ);
                echo 1;
            } else {
                $this->model->fill($OBJ);
                $this->model->save();
                echo 1;
            }
        /*} catch (\Throwable $th) {
            return 0;
        }*/
    }
    public function imagenDestroy( Request $request )
    {
        //try {
            self::delete( $this->model->find( $request->all()[ "id" ] ) , $this->model->getFillable() );
            return 1;
        /*} catch (\Throwable $th) {
            return 0;
        }*/
    }
    
    public function delete( $data , $fillable ) {
        if( in_array( "elim" , $fillable ) ) {
            $data->fill( [ "elim" => 1 ] );
            $data->save();
        } else {
            if( in_array( "image" , $fillable ) ) {
                if(!empty( $data->image )) {
                    $filename = public_path() . "/{$data->image[ 'i' ]}";
                    if ( file_exists( $filename ) )
                        unlink( $filename );
                }
            }
            if( in_array( "file" , $fillable ) ) {
                if(!empty( $data->file )) {
                    $filename = public_path() . "/{$data->file[ 'i' ]}";
                    if ( file_exists( $filename ) )
                        unlink( $filename );
                }
            }
            if( in_array( "photo" , $fillable ) ) {
                if(!empty( $data->photo )) {
                    $filename = public_path() . "/{$data->photo[ 'i' ]}";
                    if ( file_exists( $filename ) )
                        unlink( $filename );
                }
            }
            $data->delete();
        }
    }
    /**
     * Función encargada de construir los objetos a guardar
     *
     * Mejora en el merge de elementos múltiples
     * @version 2.0.0
     * @param @type object request $request
     * @param @type object $data
     * @param @type array $merge
     * @date 19/02/2020
     */
    public function object( $request , $data = null , $merge = null )
    {
        $datosRequest = $request->all();
        if( isset( $datosRequest["REMOVE"] ) ) {
            $datosRequest["REMOVE"] = json_decode( $datosRequest["REMOVE"] , true );
            for( $i = 0 ; $i < count( $datosRequest["REMOVE"] ) ; $i ++ ) {
                $filename = $datosRequest[ "REMOVE" ][ $i ];
                if ( file_exists( $filename ) )
                    unlink( $filename );
            }
        }
        $datosRequest["ATRIBUTOS"] = json_decode( $datosRequest["ATRIBUTOS"] , true );
        $OBJ = [];
        if( empty( $merge ) ) {
            $merge = [];
            for( $x = 0 ; $x < count( $datosRequest[ "ATRIBUTOS" ] ) ; $x++ ) {
                $aux = $datosRequest[ "ATRIBUTOS" ][ $x ];
                if( $aux[ "TIPO" ] != "M" )
                    continue;
                if( !isset( $datosRequest["{$aux["DATA"]["name"]}_{$aux["COLUMN"]}"] ) )
                    continue;
                for( $i = 0 ; $i < count( $datosRequest[ "{$aux[ "DATA" ][ "name" ]}_{$aux[ "COLUMN" ]}" ] ) ; $i++ ) {
                    if( !empty( $datosRequest[ "{$aux[ "DATA" ][ "name" ]}_{$aux[ "COLUMN" ]}" ][ $i ] ) ) {
                        continue;
                    }
                    $OBJ_AUX = [];
                    foreach( $aux[ "DATA" ][ "especificacion" ] AS $nombre => $tipo ) {
                        $E_aux = null;
                        $var = "{$aux[ "DATA" ][ "name" ]}";

                        if( isset( $aux[ "NAME" ] ) )
                            $var .= "_{$aux[ "NAME" ]}";

                        if( isset( $aux[ "TAG" ] ) )
                            $var .= "_{$aux[ "TAG" ]}";

                        if( isset( $aux[ "COLUMN" ] ) &&  isset( $aux[ "NAME" ] ) )
                            $var .= "_{$aux[ "COLUMN" ]}";
                        $var .= "_{$nombre}";
                        $merge[] = $var;
                    }
                }
            }

            /*for( $x = 0 ; $x < count( $datosRequest[ "ATRIBUTOS" ] ) ; $x++ ) {
                $aux = $datosRequest[ "ATRIBUTOS" ][ $x ];
                foreach( $aux[ "DATA" ][ "especificacion" ] AS $name => $type ) {
                    if( $type == "TP_TEXT" ) {
                        $var = "{$aux[ "DATA" ][ "name" ]}";

                        if( isset( $aux[ "NAME" ] ) )
                            $var .= "_{$aux[ "NAME" ]}";

                        if( isset( $aux[ "TAG" ] ) )
                            $var .= "_{$aux[ "TAG" ]}";

                        if( isset( $aux[ "COLUMN" ] ) &&  isset( $aux[ "NAME" ] ) )
                            $var .= "_{$aux[ "COLUMN" ]}";
                        $var .= "_{$name}";
                        $merge[] = $var;
                    }
                }
            }*/
        }
        if( !empty( $merge ) ) {
            $aux_datos = [];
            for( $x = 0 ; $x < count( $merge ) ; $x ++ ) {
                foreach( $datosRequest AS $k => $v ) {
                    if ( strpos( $k , $merge[ $x ] ) !== false ) {
                        $aux_key = $merge[$x];

                        if (!empty($v)) {
                            if( !isset( $aux_datos[ $aux_key ] ) )
                                $aux_datos[ $aux_key ] = [];
                            if( !is_array( $v ) )
                                $aux_datos[ $aux_key ][] = $v;
                            else {
                                if( !empty( $v[ 0 ] ) )
                                    $aux_datos[$aux_key] = $v;
                            }
                        }
                        unset( $datosRequest[$k] );
                    }
                }
            }
            if( !empty( $aux_datos ) ) {
                $datosRequest = array_merge($datosRequest, $aux_datos);
            }
        }

        for( $x = 0 ; $x < count( $datosRequest[ "ATRIBUTOS" ] ) ; $x++ ) {
            $aux = $datosRequest[ "ATRIBUTOS" ][ $x ];
            switch( $aux[ "TIPO" ] ) {
                case "U":
                    foreach( $aux[ "DATA" ][ "especificacion" ] AS $nombre => $tipo) {
                        $E_aux = null;
                        $var = "{$aux[ "DATA" ][ "name" ]}_{$nombre}";
                        if( isset( $aux[ "NAME" ] ) )
                            $var .= "_{$aux[ "NAME" ]}";

                        if( isset( $aux[ "DATA" ][ "idiomas" ] ) ) {
                            if( isset( $aux[ "DATA" ][ "idiomas" ][ $nombre ] ) ) {
                                $E_aux = [];
                                $auxVar = null;
                                for( $y = 0 ; $y < count( $aux[ "DATA" ][ "idiomas" ][ $nombre ] ) ; $y++ ) {
                                    $E_aux[ $aux[ "DATA" ][ "idiomas" ][ $nombre ][ $y ] ] = null;
                                    if( empty( $auxVar ) )
                                        $auxVar = $var;
                                    else
                                        $var = $auxVar;
                                    $var .= "_{$aux[ "DATA" ][ "idiomas" ][ $nombre ][ $y ]}";
                                    if( isset( $datosRequest[ $var ])) {
                                        if( $tipo == "TP_CHECK" ) {
                                            if( !empty( $datosRequest[ "{$var}_input" ] ) )
                                                $E_aux[ $aux[ "DATA" ][ "idiomas" ][ $nombre ][ $y ] ] = 1;
                                        } else if( $tipo == "TP_BLOB") {
                                            $path = $tipo == "TP_FILE" ? "files/" : "images/";
                                            $path .= "{$aux[ "DATA" ][ "detalles" ][ $nombre ][ "FOLDER" ]}";

                                            $path .= "/{$aux[ "DATA" ][ "idiomas" ][ $nombre ][ $y ]}";
                                            if ( !file_exists( $path ) )
                                                mkdir( $path , 0777 , true );

                                            $file = $request->file( $var );
                                            if( !is_null( $file ) ) {
                                                $imgData = base64_encode(file_get_contents($file));

                                                $E_aux[ $aux[ "DATA" ][ "idiomas" ][ $nombre ][ $y ] ] = $imgData;
                                                $OBJ["mime"] = image_type_to_mime_type(exif_imagetype($file));
                                            }
                                        } else if( $tipo == "TP_FILE" || $tipo == "TP_IMAGE") {
                                            $path = $tipo == "TP_FILE" ? "files/" : "images/";
                                            //dd($nombre);
                                            $path .= "{$aux[ "DATA" ][ "detalles" ][ $nombre ][ "FOLDER" ]}";

                                            $path .= "/{$aux[ "DATA" ][ "idiomas" ][ $nombre ][ $y ]}";
                                            if ( !file_exists( $path ) )
                                                mkdir( $path , 0777 , true );

                                            $file = $request->file( $var );
                                            //dd($file);
                                            if( !is_null( $file ) ) {
                                                $fileName = null;
                                                if( !empty( $data ) ) {
                                                    if( isset( $aux[ "COLUMN" ] ) && isset( $aux[ "NAME" ] ) ) {
                                                        if( isset( $data[ $aux[ "COLUMN" ] ] ) && isset( $data[ $aux[ "NAME" ] ] ) )
                                                            $E_aux[ $aux[ "DATA" ][ "idiomas" ][ $nombre ][ $y ] ] = $data[ $aux[ "COLUMN" ] ][ $nombre ][ $data[ $aux[ "NAME" ] ] ];
                                                        else
                                                            $E_aux[ $aux[ "DATA" ][ "idiomas" ][ $nombre ][ $y ] ] = $data[ $nombre ];
                                                    } else if( isset( $aux[ "COLUMN" ] ) ) {
                                                        if( isset( $data[ $aux[ "COLUMN" ] ] ) ) {
                                                            if( isset( $data[ $aux[ "COLUMN" ] ][ $nombre ] ) )
                                                                $E_aux[ $aux[ "DATA" ][ "idiomas" ][ $nombre ][ $y ] ] = $data[ $aux[ "COLUMN" ] ][ $nombre ];
                                                        } else
                                                            $E_aux[ $aux[ "DATA" ][ "idiomas" ][ $nombre ][ $y ] ] = $data[ $nombre ];
                                                    } else {
                                                        if( isset( $data[ $nombre ] ) )
                                                            $E_aux[ $aux[ "DATA" ][ "idiomas" ][ $nombre ][ $y ] ] = $data[ $nombre ];
                                                    }
                                                    if( isset( $E_aux[ $aux[ "DATA" ][ "idiomas" ][ $nombre ][ $y ] ][ "n" ] ) )
                                                        $fileName = $E_aux[ $aux[ "DATA" ][ "idiomas" ][ $nombre ][ $y ] ][ "n" ];
                                                }
                                                if( empty( $fileName ) )
                                                    $fileName = $tipo == "TP_FILE" ? $file->getClientOriginalName() : time() . "_{$nombre}";
                                                $ext = $file->getClientOriginalExtension();
                                                if( strpos( $fileName , "." ) ) {
                                                    list( $nnn , $ext ) = explode( "." , $fileName );
                                                    $fileName = $nnn;
                                                }
                                                $file->move( $path , "{$fileName}.{$ext}" );
                                                $E_aux[ $aux[ "DATA" ][ "idiomas" ][ $nombre ][ $y ] ] = [
                                                    "i" => "{$path}/{$fileName}.{$ext}",
                                                    "e" => $ext,
                                                    "n" => $fileName,
                                                    "d" => $tipo == "TP_FILE" ? null : getimagesize( "{$path}/{$fileName}.{$ext}" )
                                                ];
                                            }
                                        } else {
                                            if( isset( $datosRequest[ $var ] ) )
                                                $E_aux[ $aux[ "DATA" ][ "idiomas" ][ $nombre ][ $y ] ] = $datosRequest[ $var ];
                                            if( isset( $aux[ "DATA" ][ "detalles" ][ $nombre ] ) ) {
                                                if( isset( $aux[ "DATA" ][ "detalles" ][ $nombre ][ "CAST" ] ) ) {
                                                    if( !empty( $aux[ "DATA" ][ "detalles" ][ $nombre ][ "CAST" ] ) )
                                                        $E_aux[ $aux[ "DATA" ][ "idiomas" ][ $nombre ][ $y ] ] = str_slug( $OBJ[ $aux[ "DATA" ][ "detalles" ][ $nombre ][ "CAST" ] ] );
                                                }
                                            }
                                        }
                                    } else {
                                        if( $tipo == "TP_FILE" || $tipo == "TP_IMAGE" || $tipo == "TP_BLOB" ) {
                                            if( isset( $aux[ "COLUMN" ] ) ) {
                                                if( isset( $data[ $aux[ "COLUMN" ] ] ) ) {
                                                    if( isset( $data[ $aux[ "COLUMN" ] ][ $nombre ] ) )
                                                        $E_aux[ $aux[ "DATA" ][ "idiomas" ][ $nombre ][ $y ] ] = $data[ $aux[ "COLUMN" ] ][ $nombre ];
                                                } else
                                                    $E_aux[ $aux[ "DATA" ][ "idiomas" ][ $nombre ][ $y ] ] = $data[ $nombre ];
                                            } else
                                                $E_aux[ $aux[ "DATA" ][ "idiomas" ][ $nombre ][ $y ] ] = $data[ $nombre ];
                                        }

                                        if( isset( $aux[ "DATA" ][ "detalles" ][ $nombre ] ) ) {
                                            if( isset( $aux[ "DATA" ][ "detalles" ][ $nombre ][ "CAST" ] ) ) {
                                                if( !empty( $aux[ "DATA" ][ "detalles" ][ $nombre ][ "CAST" ] ) )
                                                    $E_aux[ $aux[ "DATA" ][ "idiomas" ][ $nombre ][ $y ] ] = str_slug( $OBJ[ $aux[ "DATA" ][ "detalles" ][ $nombre ][ "CAST" ] ][ $aux[ "DATA" ][ "idiomas" ][ $nombre ][ $y ] ] );
                                            }
                                        }
                                    }
                                }// END FOR
                                if( isset( $aux[ "KEY" ] ) ) {
                                    if( !isset( $OBJ[ $aux[ "KEY" ] ] ) )
                                        $OBJ[ $aux[ "KEY" ] ] = [];

                                    $OBJ[ $aux[ "KEY" ] ][ $nombre ] = $E_aux;
                                } else {
                                    if( isset( $aux[ "COLUMN" ] ) && isset( $aux[ "NAME" ] ) ) {
                                        if( !isset( $OBJ[ $aux[ "COLUMN" ] ][ $aux[ "NAME" ] ] ) )
                                            $OBJ[ $aux[ "COLUMN" ] ][ $aux[ "NAME" ] ] = [];
                                        $OBJ[ $aux[ "COLUMN" ] ][ $aux[ "NAME" ] ][ $nombre ] = $E_aux;
                                    } else if( isset( $aux[ "COLUMN" ] ) ) {
                                        if( !isset( $OBJ[ $aux[ "COLUMN" ] ] ) )
                                            $OBJ[ $aux[ "COLUMN" ] ] = [];
                                        $OBJ[ $aux[ "COLUMN" ] ][ $nombre ] = $E_aux;
                                    } else
                                        $OBJ[ $nombre ] = $E_aux;
                                }
                                continue;
                            }
                        }// END IF

                        if( isset( $datosRequest[ $var ])) {
                            if( $tipo == "TP_CHECK" ) {
                                if( !empty( $datosRequest[ "{$var}_input" ] ) )
                                    $E_aux = 1;
                            } else if( $tipo == "TP_BLOB") {
                                $file = $request->file( $var );
                                if( !is_null( $file ) ) {
                                    $imgData = base64_encode(file_get_contents($file));

                                    $E_aux = $imgData;
                                    $OBJ["mime"] = image_type_to_mime_type(exif_imagetype($file));
                                }
                            } else if( $tipo == "TP_FILE" || $tipo == "TP_IMAGE") {

                                $path = $tipo == "TP_FILE" ? "files/" : "images/";
                                $path .= "{$aux[ "DATA" ][ "detalles" ][ $nombre ][ "FOLDER" ]}";
                                if ( !file_exists( $path ) )
                                    mkdir( $path , 0777 , true );
                                //dd($path);
                                $file = $request->file( $var );

                                if( !is_null( $file ) ) {
                                    $fileName = null;
                                    if( !empty( $data ) ) {
                                        if( isset( $aux[ "COLUMN" ] ) && isset( $aux[ "NAME" ] ) ) {
                                            if( isset( $data[ $aux[ "COLUMN" ] ] ) && isset( $data[ $aux[ "NAME" ] ] ) )
                                                $E_aux = $data[ $aux[ "COLUMN" ] ][ $nombre ][ $data[ $aux[ "NAME" ] ] ];
                                            else
                                                $E_aux = $data[ $nombre ];
                                        } else if( isset( $aux[ "COLUMN" ] ) ) {
                                            if( isset( $data[ $aux[ "COLUMN" ] ] ) ) {
                                                if( isset( $data[ $aux[ "COLUMN" ] ][ $nombre ] ) )
                                                    $E_aux = $data[ $aux[ "COLUMN" ] ][ $nombre ];
                                            } else {
                                                if( isset( $data[ $nombre ] ) )
                                                    $E_aux = $data[ $nombre ];
                                            }
                                        } else {
                                            if( isset( $data[ $nombre ] ) )
                                                $E_aux = $data[ $nombre ];
                                        }
                                        if( isset( $E_aux[ "n" ] ) )
                                            $fileName = $E_aux[ "n" ];
                                    }
                                    if( empty( $fileName ) || $tipo == "TP_FILE" )
                                        $fileName = $tipo == "TP_FILE" ? $file->getClientOriginalName() : time() . "_{$nombre}";

                                    $ext = $file->getClientOriginalExtension();
                                    if( strpos( $fileName , "." ) ) {
                                        list( $nnn , $ext ) = explode( "." , $fileName );
                                        $fileName = $nnn;
                                    }
                                    if( !in_array( pathinfo( "{$fileName}.{$ext}" , PATHINFO_EXTENSION) , $this->acceptedFormats ) ) {
                                        return 2;
                                    }
                                    $file->move( $path , "{$fileName}.{$ext}" );
                                    $E_aux = [
                                        "i" => "{$path}/{$fileName}.{$ext}",
                                        "e" => $ext,
                                        "n" => $fileName,
                                        "d" => $tipo == "TP_FILE" ? null : getimagesize( "{$path}/{$fileName}.{$ext}" )
                                    ];
                                    //dd($E_aux);
                                }
                            } else {
                                if( isset( $datosRequest[ $var ] ) )
                                    $E_aux = $datosRequest[ $var ];

                                if( isset( $aux[ "DATA" ][ "detalles" ][ $nombre ] ) ) {
                                    if( isset( $aux[ "DATA" ][ "detalles" ][ $nombre ][ "CAST" ] ) ) {
                                        if( !empty( $aux[ "DATA" ][ "detalles" ][ $nombre ][ "CAST" ] ) )
                                            $E_aux = str_slug( $OBJ[ $aux[ "DATA" ][ "detalles" ][ $nombre ][ "CAST" ] ] );
                                    }
                                    if( isset( $aux[ "DATA" ][ "detalles" ][ $nombre ][ "PASSWORD" ] ) ) {
                                        if( !empty( $datosRequest[ $var ] ) )
                                            $E_aux = Hash::make($datosRequest[ $var ]);
                                    }
                                }
                            }
                        } else {
                            if( $tipo == "TP_FILE" || $tipo == "TP_IMAGE" || $tipo == "TP_BLOB" ) {
                                if( isset( $aux[ "COLUMN" ] ) ) {
                                    if( isset( $data[ $aux[ "COLUMN" ] ] ) ) {
                                        if( isset( $data[ $aux[ "COLUMN" ] ][ $nombre ] ) )
                                            $E_aux = $data[ $aux[ "COLUMN" ] ][ $nombre ];
                                    } else
                                        $E_aux = $data[ $nombre ];
                                } else
                                    $E_aux = $data[ $nombre ];
                            }
                            //dd($E_aux);
                            if( isset( $aux[ "DATA" ][ "detalles" ][ $nombre ] ) ) {
                                if( isset( $aux[ "DATA" ][ "detalles" ][ $nombre ][ "CAST" ] ) ) {
                                    if( !empty( $aux[ "DATA" ][ "detalles" ][ $nombre ][ "CAST" ] ) )
                                        $E_aux = str_slug( $OBJ[ $aux[ "DATA" ][ "detalles" ][ $nombre ][ "CAST" ] ] );
                                }
                                if( isset( $aux[ "DATA" ][ "detalles" ][ $nombre ][ "PASSWORD" ] ) ) {
                                    if( !empty( $datosRequest[ $var ] ) )
                                        $E_aux = Hash::make($datosRequest[ $var ]);
                                    else
                                        $E_aux = $data[ $nombre ];
                                }
                            }
                        }

                        if( isset( $aux[ "KEY" ] ) ) {
                            if( !isset( $OBJ[ $aux[ "KEY" ] ] ) )
                                $OBJ[ $aux[ "KEY" ] ] = [];

                            $OBJ[ $aux[ "KEY" ] ][ $nombre ] = $E_aux;
                        } else {
                            if( isset( $aux[ "COLUMN" ] ) && isset( $aux[ "NAME" ] ) ) {
                                if( !isset( $OBJ[ $aux[ "COLUMN" ] ][ $aux[ "NAME" ] ] ) )
                                    $OBJ[ $aux[ "COLUMN" ] ][ $aux[ "NAME" ] ] = [];
                                $OBJ[ $aux[ "COLUMN" ] ][ $aux[ "NAME" ] ][ $nombre ] = $E_aux;
                            } else if( isset( $aux[ "COLUMN" ] ) ) {
                                if( !isset( $OBJ[ $aux[ "COLUMN" ] ] ) )
                                    $OBJ[ $aux[ "COLUMN" ] ] = [];
                                $OBJ[ $aux[ "COLUMN" ] ][ $nombre ] = $E_aux;
                            } else
                                $OBJ[ $nombre ] = $E_aux;
                        }
                    }
                    break;
                case "M":

                    if( !isset( $datosRequest[ "{$aux[ "DATA" ][ "name" ]}_{$aux[ "COLUMN" ]}" ] ) )
                        continue 2;
                    for( $i = 0 ; $i < count( $datosRequest[ "{$aux[ "DATA" ][ "name" ]}_{$aux[ "COLUMN" ]}" ] ) ; $i++ ) {
                        if( !empty( $datosRequest[ "{$aux[ "DATA" ][ "name" ]}_{$aux[ "COLUMN" ]}" ][ $i ] ) )
                            continue;
                        $OBJ_AUX = [];
                        foreach( $aux[ "DATA" ][ "especificacion" ] AS $nombre => $tipo ) {
                            $E_aux = null;
                            $var = "{$aux[ "DATA" ][ "name" ]}";

                            if( isset( $aux[ "NAME" ] ) )
                                $var .= "_{$aux[ "NAME" ]}";

                            if( isset( $aux[ "TAG" ] ) )
                                $var .= "_{$aux[ "TAG" ]}";

                            if( isset( $aux[ "COLUMN" ] ) &&  isset( $aux[ "NAME" ] ) )
                                $var .= "_{$aux[ "COLUMN" ]}";
                            $var .= "_{$nombre}";
                            if($tipo == "TP_FILE" || $tipo == "TP_IMAGE") {
                                $path = $tipo == "TP_FILE" ? "files/" : "images/";
                                $path .= "{$aux[ "DATA" ][ "detalles" ][ $nombre ][ "FOLDER" ]}";

                                if ( !file_exists( $path ) )
                                    mkdir($path, 0777, true);
                                if( empty( $datosRequest["{$var}_URL"][ $i ] ) ) {
                                    if( isset( $request->file( $var )[ $i ] ) ) {
                                        $file = $request->file( $var )[ $i ];
                                        if( !empty( $file ) ) {
                                            $fileName = $tipo == "TP_FILE" ? $file->getClientOriginalName() : time() . "_{$nombre}_{$x}_{$i}";
                                            $ext = $file->getClientOriginalExtension();
                                            if( strpos( $fileName , "." ) ) {
                                                list( $nnn , $ext ) = explode( "." , $fileName );
                                                $fileName = $nnn;
                                            }
                                            //dd($fileName);
                                            if( !in_array( pathinfo( "{$fileName}.{$ext}" , PATHINFO_EXTENSION) , $this->acceptedFormats ) ) {
                                                return 2;
                                            }
                                            $file->move( $path , "{$fileName}.{$ext}" );
                                            $E_aux = [
                                                "i" => "{$path}/{$fileName}.{$ext}",
                                                "e" => $ext,
                                                "n" => $fileName,
                                                "d" => $tipo == "TP_FILE" ? null : getimagesize( "{$path}/{$fileName}.{$ext}" )
                                            ];
                                        }
                                    } else {
                                        if( $tipo == "TP_FILE" || $tipo == "TP_IMAGE" ) {
                                            if( isset( $aux[ "KEY" ] ) ) {
                                                if( isset( $data[ $aux[ "KEY" ] ] ) ) {
                                                    $E_aux = $data[ $aux[ "KEY" ] ];
                                                }
                                            }

                                            if( isset( $aux[ "COLUMN" ] ) ) {
                                                if( isset( $data[ $aux[ "COLUMN" ] ] ) ) {
                                                    if( isset( $data[ $aux[ "COLUMN" ] ][ $i ] ) ) {
                                                        $E_aux = $data[ $aux[ "COLUMN" ] ];
                                                    }
                                                }
                                            }
                                            if( empty( $E_aux ) ) {
                                                $E_aux = $data;
                                            }
                                            if( isset( $E_aux[ $i ] ) ) {
                                                if( isset( $E_aux[ $i ][ $nombre ] ) )
                                                    $E_aux = $E_aux[ $i ][ $nombre ];
                                            }
                                        }
                                    }
                                } else {
                                    if( !empty( $data ) ) {
                                        if( isset( $aux[ "KEY" ] ) ) {
                                            if( isset( $data[ $aux[ "KEY" ] ] ) ) {
                                                $E_aux = $data[ $aux[ "KEY" ] ];
                                            }
                                        }
                                        if( isset( $aux[ "COLUMN" ] ) ) {
                                            if( isset( $data[ $aux[ "COLUMN" ] ] ) ) {
                                                if( isset( $data[ $aux[ "COLUMN" ] ][ $i ] ) ) {
                                                    $E_aux = $data[ $aux[ "COLUMN" ] ];
                                                }
                                            }
                                        }
                                        if( empty( $E_aux ) ) {
                                            $E_aux = $data;
                                        }

                                        for( $xx = 0 ; $xx < count( $E_aux ) ; $xx ++ ) {
                                            if( strcmp( asset( $E_aux[ $xx ][ $nombre ][ "i" ] ) , $datosRequest["{$var}_URL"][ $i ] ) == 0 )
                                                break;
                                        }
                                        $E_aux = $E_aux[ $xx ];
                                        if( isset( $E_aux[ $nombre ] ) )
                                            $E_aux = $E_aux[ $nombre ];
                                    }
                                    if( isset( $request->file( $var )[ $i ] ) ) {
                                        $file = $request->file( $var )[ $i ];
                                        $fileName = null;
                                        if( !empty( $E_aux ) ) {
                                            if( isset( $E_aux[ $nombre ] ) )
                                                $E_aux = $E_aux[ $nombre ];
                                            if( isset( $E_aux[ "n" ] ) )
                                                $fileName = $E_aux[ "n" ];
                                            else {
                                                $auxFILE = explode( "/" , $E_aux[ "i" ] );
                                                $fileName = $auxFILE[ count( $auxFILE ) - 1 ];
                                            }
                                        }
                                        if( empty( $fileName ) )
                                            $fileName = $tipo == "TP_FILE" ? $file->getClientOriginalName() : time() . "_{$nombre}_{$x}_{$i}";
                                        $ext = $file->getClientOriginalExtension();
                                        if( strpos( $fileName , "." ) ) {
                                            list( $nnn , $ext ) = explode( "." , $fileName );
                                            $fileName = $nnn;
                                        }
                                        //dd($fileName);
                                        if( !in_array( pathinfo( "{$fileName}.{$ext}" , PATHINFO_EXTENSION) , $this->acceptedFormats ) ) {
                                            return 2;
                                        }
                                        $file->move( $path , "{$fileName}.{$ext}" );
                                        $E_aux = [
                                            "i" => "{$path}/{$fileName}.{$ext}",
                                            "e" => $ext,
                                            "n" => $fileName,
                                            "d" => $tipo == "TP_FILE" ? null : getimagesize( "{$path}/{$fileName}.{$ext}" )
                                        ];
                                    }
                                }

                            } else {
                                if( isset( $datosRequest[ $var ] ) ) {
                                    if( $tipo == "TP_CHECK" ) {
                                        if( !empty( $datosRequest[ "{$var}" ][ $i ] ) ) {
                                            if( isset( $aux[ "DATA" ][ "idiomas" ] ) )
                                                $E_aux[ $aux[ "DATA" ][ "idiomas" ][ $nombre ][ $y ] ] = 1;
                                            else
                                                $E_aux = 1;
                                        }
                                    } else {
                                        if( isset( $datosRequest[ $var ][ $i ] ) ) {
                                            if( isset( $aux[ "DATA" ][ "idiomas" ][ $nombre ] ) )
                                                $E_aux[ $aux[ "DATA" ][ "idiomas" ][ $nombre ][ $y ] ] = $datosRequest[ $var ][ $i ];
                                            else
                                                $E_aux = $datosRequest[ $var ][ $i ];
                                        }
                                    }
                                } else {

                                    if( $tipo == "TP_FILE" || $tipo == "TP_IMAGE" ) {
                                        if( isset( $datosRequest[ "{$aux[ "DATA" ][ "name" ]}_removeIcono" ] ) ) {
                                            if( $datosRequest[ "{$aux[ "DATA" ][ "name" ]}_removeIcono" ][ $i ] ) {
                                                //$icono = json_decode( $datosRequest[ "{$aux[ "DATA" ][ "name" ]}_imageURL" ][ $i ] );
                                                continue 2;
                                            }
                                        }
                                        $E_aux = null;
                                        if( !empty( $data ) ) {
                                            if( isset( $aux[ "KEY" ] ) ) {
                                                if( isset( $data[ $aux[ "KEY" ] ] ) ) {
                                                    $E_aux = $data[ $aux[ "KEY" ] ];
                                                }
                                            }
                                            if( isset( $aux[ "COLUMN" ] ) ) {
                                                if( isset( $data[ $aux[ "COLUMN" ] ] ) ) {
                                                    if( isset( $data[ $aux[ "COLUMN" ] ][ $i ] ) ) {
                                                        $E_aux = $data[ $aux[ "COLUMN" ] ];
                                                    }
                                                }
                                            }
                                            if( empty( $E_aux ) ) {
                                                $E_aux = $data;
                                            }
                                            //dd($datosRequest["{$var}_URL"][ $i ]);
                                            for( $xx = 0 ; $xx < count( $E_aux ) ; $xx ++ ) {
                                                if( strcmp( asset( $E_aux[ $xx ][ "image" ][ "i" ] ) , $datosRequest["{$var}_URL"][ $i ] ) == 0 )
                                                    break;
                                            }
                                            $E_aux = $E_aux[ $x ][ $nombre ];
                                        }
                                        //dd($E_aux);
                                    }
                                }
                            }
                            $OBJ_AUX[ $nombre ] = $E_aux;
                            //if( $nombre != "icon")
                            //dd($OBJ_AUX);
                        }
                        if( isset( $aux[ "KEY" ] ) ) {
                            if( !isset( $OBJ[ $aux[ "KEY" ] ] ) )
                                $OBJ[ $aux[ "KEY" ] ] = [];
                            if( isset( $aux[ "VALUE" ] ) ) {
                                if( !isset( $OBJ[ $aux[ "KEY" ] ][ $aux[ "VALUE" ] ] ) )
                                    $OBJ[ $aux[ "KEY" ] ][ $aux[ "VALUE" ] ] = [];

                                $OBJ[ $aux[ "KEY" ] ][ $aux[ "VALUE" ] ][] = $OBJ_AUX;
                            } else
                                $OBJ[ $aux[ "KEY" ] ][] = $OBJ_AUX;
                        } else
                            $OBJ[] = $OBJ_AUX;
                    }
                    if( isset( $aux[ "KEY" ] ) ) {
                        if( isset( $OBJ[ $aux[ "KEY" ] ] ) ) {
                            for( $i = 0; $i < count( $OBJ[ $aux[ "KEY" ] ] ) - 1 ; $i ++ ) {
                                if( !isset( $OBJ[ $aux[ "KEY" ] ][ $i ][ "order" ] ) )
                                    break 1;
                                    for( $j = $i + 1; $j < count( $OBJ[ $aux[ "KEY" ] ] ) ; $j ++ ) {
                                        if( $OBJ[ $aux[ "KEY" ] ][ $i ][ "order" ] > $OBJ[ $aux[ "KEY" ] ][ $j ][ "order" ] ) {
                                            $temp = $OBJ[ $aux[ "KEY" ] ][ $i ];
                                            $OBJ[ $aux[ "KEY" ] ][ $i ] = $OBJ[ $aux[ "KEY" ] ][ $j ];
                                            $OBJ[ $aux[ "KEY" ] ][ $j ] = $temp;
                                        }
                                    }
                            }
                        }
                    }
                    break;
                case "A":
                    $OBJ_AUX = null;
                    $OBJ_N = null;
                    foreach( $aux[ "DATA" ][ "especificacion" ] AS $nombre => $tipo ) {
                        $var = "{$aux[ "DATA" ][ "name" ]}";
                        if( isset( $aux[ "NAME" ] ) )
                            $var .= "_{$aux[ "NAME" ]}";
                        if( isset( $aux[ "COLUMN" ] ) )
                            $var .= "_{$aux[ "COLUMN" ]}";
                        $OBJ_N = $datosRequest[ $var ];
                        $var .= "_{$nombre}";
                        if( isset( $datosRequest[ $var ] ) )
                            $OBJ_AUX = $datosRequest[ $var ];
                    }
                    for( $i = 0 ; $i < count( $OBJ_N ) ; $i++ ) {
                        if( !empty( $OBJ_N[ $i ] ) )
                            array_splice( $OBJ_AUX , $i , 1 );
                    }

                    if( isset( $aux[ "COLUMN" ] ) && isset( $aux[ "NAME" ] ) ) {
                        if( !isset( $OBJ[ $aux[ "COLUMN" ] ][ $aux[ "NAME" ] ] ) )
                            $OBJ[ $aux[ "COLUMN" ] ][ $aux[ "NAME" ] ] = [];
                        $OBJ[ $aux[ "COLUMN" ] ][ $aux[ "NAME" ] ] = $OBJ_AUX;
                    } else if( isset( $aux[ "COLUMN" ] ) )
                        $OBJ[ $aux[ "COLUMN" ] ] = $OBJ_AUX;
                    else if( isset( $aux[ "KEY" ] ) )
                        $OBJ[ $aux[ "KEY" ] ] = $OBJ_AUX;
                    else
                        $OBJ = $OBJ_AUX;
                    break;
            }

        }

        return $OBJ;
    }

    public function clear ( $text ) {
        return str_replace( ["&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&ntilde;","&Aacute;","&Eacute;","&Iacute;","&Oacute;","&Uacute;","&Ntilde;"], [ "á","é","í","ó","ú","ñ","Á","É","Í","Ó","Ú","Ñ" ], $text);
    }
}