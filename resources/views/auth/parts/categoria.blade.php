<section class="my-3">
    <div class="container-fluid">
        <div class="wrapper-servicio wrapper-categoria py-4 bg-white mb-4">
            @include( 'page.parts.categorias' , [ 'categorias' => $data[ 'elementos' ] , 'link' => 0 ] )
        </div>
        @include( 'layouts.general.form' , [ 'buttonADD' => 1 , 'form' => 0 , 'close' => 1 , 'modal' => 1 ] )
        @if( isset( $data[ 'buscar' ] ) )
            @include( 'layouts.general.table' , [ 'paginate' => $data[ "elementos" ] , 'buscar' => $data[ 'buscar' ] ] )
        @else
            @include( 'layouts.general.table' , [ 'paginate' => $data[ "elementos" ] ] )
        @endif
    </div>
</section>
@push('scripts')
<script>
    window.pyrus = new Pyrus( "categoria" , null , src );
    
    partesFunction = ( t , id ) => {
        window.location = `${url_simple}/adm/categoria/${id}/subcategorias`;
    };
    
    init = ( callbackOK ) => {
        $( "#form .modal-body" ).html( window.pyrus.formulario() );
        /** */
        $( "#wrapper-tabla > div.card-body" ).html( window.pyrus.table( [ { NAME:"ACCIONES" , COLUMN: "acciones" , CLASS: "text-center" , WIDTH: "150px" } ] ) );
        
        window.pyrus.elements( $( "#tabla" ) , url_simple , window.data.elementos , [ "e" , "d" ] , [ { icon : '<i class="fab fa-modx"></i>' , class: 'btn-dark' , function : 'partes' , title : "Sub categorías" } ] );
        
        callbackOK.call( this , null );
    };

    init( () => {} );
</script>
@endpush