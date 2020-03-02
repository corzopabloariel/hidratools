<section class="my-3">
    <div class="container-fluid">
        @include( 'layouts.general.form', [ 'buttonADD' => 0 , 'form' => 0 , 'close' => 1 , 'modal' => 1 ] )
        @include( 'layouts.general.table' )
    </div>
</div>

@push('scripts')
<script>
    window.pyrus = new Pyrus("metadatos");

    /** ------------------------------------- */
    
    add = function(t, seccion = "", data = null) {
        let btn = $(t);
        let action = `${url_simple}/adm/${window.pyrus.name}/update/${seccion}`;
        let method = "PUT";
        window.formAction = "UPDATE";
        window.elementData = data;

        $( "#formModalLabel" ).text( "Editar elemento " + seccion.toUpperCase()  );
        
        window.pyrus.show( CKEDITOR , url_simple , data );
        $( `#${window.pyrus.name}_seccion` ).val( seccion );
        $( "#form" ).prop( "action" , action ).prop( "method" , method );
        $( "#formModal" ).modal( "show" );
        $('.modal input[type="text"]:visible:enabled:first' ).focus();
    };
    /** ------------------------------------- */
    edit = function(t, seccion) {
        $( '[data-toggle="tooltip"]' ).tooltip( 'hide' );
        add( $( "#btnADD" ) , seccion , window.data.elementos.metadata[ seccion ] );
    };
    /** ------------------------------------- */
    /** -------------------------------------
     *      INICIO
     ** ------------------------------------- */
    init = ( callbackOK ) => {
        /** */
        $( "#form .modal-body" ).html( window.pyrus.formulario() );
        $( "#wrapper-tabla > div.card-body" ).html( window.pyrus.table( [ { NAME:"ACCIONES" , COLUMN: "acciones" , CLASS: "text-center" , WIDTH: "150px" } ] ) );
        
        window.pyrus.editor( CKEDITOR );
        window.pyrus.elements( $( "#tabla" ) , url_simple , window.data.elementos.metadata , [ "e" ] );
        callbackOK.call( this , null );
    };
    init( () => {});
</script>
@endpush