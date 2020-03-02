<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactoMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $data )
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->replyTo( $this->data[ "email" ], $this->data[ "nombre" ] )
                ->from( $this->data[ "email" ] , $this->data[ "nombre" ] )
                ->subject( "Formulario de Contacto" )->view( 'form.contacto' )->with( $this->data );
    }
}
