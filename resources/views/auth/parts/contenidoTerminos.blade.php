<section class="my-3">
    <div class="container-fluid">
        @include( 'layouts.general.form', [ 'buttonADD' => 0 , 'form' => 1 , 'close' => 0 , 'url' => url('/adm/contenido/' . $data['section'] . '/update') , 'modal' => 0 ] )
    </div>
</section>
@push('scripts')
<script>
    window.pyrus = new Pyrus("terminos", null, src);

    /** ------------------------------------- */
    init = ( callbackOK ) => {
        /** */
        $("#form .container-form").html( window.pyrus.formulario() );
        window.pyrus.editor( CKEDITOR );
        
        callbackOK.call( this );
    };
    /** */
    init( () => {
        window.pyrus.show( CKEDITOR , null , window.data.elementos.data );
    });
</script>
@endpush
