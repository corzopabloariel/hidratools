<section class="my-3">
    <div class="container-fluid">
        <div class="mb-4">
            @include( 'page.parts.empresa' , [ 'elemento' => $data[ 'elementos' ]->data , 'sliders' => $data[ 'sliders' ] ] )
        </div>
        @include( 'layouts.general.form', [ 'buttonADD' => 0 , 'form' => 1 , 'close' => 0 , 'url' => url('/adm/contenido/' . $data['section'] . '/update') , 'modal' => 0 ] )
    </div>
</section>
@push('scripts')
<script>
    window.pyrus = new Pyrus("contenido_empresa", null, src);
    

    /** ------------------------------------- */
    init = ( callbackOK ) => {
        /** */
        let form = "";
        
        form += window.pyrus.formulario();

        $("#form .container-form").html( form );
        
        window.pyrus.editor( CKEDITOR );
        callbackOK.call( this );
    };
    /** */
    init( () => {
        if( Object.keys( window.data.elementos.data ).length != 0 )
            window.pyrus.show( CKEDITOR , url_simple , window.data.elementos.data );
    });
</script>
@endpush