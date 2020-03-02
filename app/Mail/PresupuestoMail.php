<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PresupuestoMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $data , $file )
    {
        $this->data = $data;
        $this->file = $file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $title = "Presupuesto";
        if( isset( $this->data[ "producto" ] ) )
            $title = "Consulta de producto";
        if( isset( $this->data[ "servicio" ] ) )
            $title = "Consulta de servicio";
        if( !empty( $this->file ) ) {
            return $this->replyTo( $this->data[ "email" ], $this->data[ "nombre" ] )->subject( $title )->view('form.presupuesto')->with( $this->data )->attach($this->file->getRealPath(),
            [
                'as' => $this->file->getClientOriginalName(),
                'mime' => $this->file->getClientMimeType(),
            ]);
        }
        return $this->replyTo( $this->data[ "email" ], $this->data[ "nombre" ] )
                ->from( $this->data[ "email" ] , $this->data[ "nombre" ] )
                ->subject( $title )->view('form.presupuesto')->with( $this->data );
        if( !empty( $this->file ) ) {
            return $this->replyTo( $this->data[ "email" ], $this->data[ "nombre" ] )->subject( $title )->view('form.presupuesto')->with( $this->data )->attach($this->file->getRealPath(),
            [
                'as' => $this->file->getClientOriginalName(),
                'mime' => $this->file->getClientMimeType(),
            ]);
        }
        return $this->replyTo( $this->data[ "email" ], $this->data[ "nombre" ] )
                ->from( $this->data[ "email" ] , $this->data[ "nombre" ] )
                ->subject( $title )->view('form.presupuesto')->with( $this->data );
    }
}
