<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactoMail;
use App\Mail\PresupuestoMail;

use App\Empresa;

class FormController extends Controller
{
    public $data;
    public $traducciones;
    public function __construct() {
        $this->data = Empresa::first();
    }
    public function contacto( Request $request ) {
        $dataRequest = $request->all();
        unset( $dataRequest[ "_token" ] );
        $email = $this->data->form[ "contacto" ];

        $captcha = $dataRequest[ "token" ];
        if(!$captcha){
            return [ "estado" => 0 , "mssg" => "Captcha no verificado"];
            exit;
        }
        $ip = $_SERVER['REMOTE_ADDR'];
        
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array('secret' => $this->data->captcha[ 'private' ], 'response' => $captcha);
        
        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            ]
        ];
        $context  = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        $responseKeys = json_decode($response,true);
        if($responseKeys["success"]) {
            Mail::to( $email )->send( new ContactoMail( $dataRequest ) );
        
            if( count( Mail::failures() ) > 0 )
                return [ "estado" => 0 , "mssg" => "Ocurrió un error" ];
            else
                return [ "estado" => 1 , "mssg" => "Formulario enviado correctamente" ];
        } else {
            return [ "estado" => 0 , "mssg" => "Ocurrió un error" ];
        }
    }

    public function presupuesto( Request $request ) {
        $dataRequest = $request->all();
        unset( $dataRequest[ "_token" ] );
        $file = $request->file('file');
        $email = $this->data->form[ "presupuesto" ];
        
        $captcha = $dataRequest[ "token" ];
        if(!$captcha){
            return [ "estado" => 0 , "mssg" => "Captcha no verificado"];
            exit;
        }
        $ip = $_SERVER['REMOTE_ADDR'];
        
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array('secret' => $this->data->captcha[ 'private' ], 'response' => $captcha);
        
        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            ]
        ];
        $context  = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        $responseKeys = json_decode($response,true);
        if($responseKeys["success"]) {
            Mail::to( $email )->send( new PresupuestoMail( $dataRequest , $file ) );
        
            if( count( Mail::failures() ) > 0 )
                return [ "estado" => 0 , "mssg" => "Ocurrió un error" ];
            else
                return [ "estado" => 1 , "mssg" => "Presupuesto enviado correctamente" ];
        } else {
            return [ "estado" => 0 , "mssg" => "Ocurrió un error" ];
        }
    }
}
