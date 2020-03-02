<section class="my-3">
    <div class="container-fluid">
        @include( 'layouts.general.form' , [ 'buttonADD' => 1 , 'form' => 1 , 'close' => 1 , 'modal' => 1 ] )
        @include( 'layouts.general.table' , [ 'paginate' => $data[ "elementos" ] ] )
    </div>
</section>
@push('scripts')
<script>
    window.pyrus = new Pyrus("descarga" , null , src );
    window.pyrus_parte = new Pyrus("descarga_parte", null , src );

    formSubmit = ( t ) => {
        let idForm = t.id;
        let formElement = document.getElementById( idForm );

        let formData = new FormData( formElement );
        formData.append( "ATRIBUTOS", JSON.stringify(
            [
                { DATA: window.pyrus.objetoSimple, TIPO: "U" },
                { DATA: window.pyrus_parte.objetoSimple, TIPO: "M", COLUMN: "file" , TAG : "file" , KEY : "file" },
            ]
        ));
        for( let x in CKEDITOR.instances )
            formData.set( x , CKEDITOR.instances[ `${x}` ].getData() );
        formSave( t , formData );
    };
    addfinish = ( data = null ) => {
        if( data === null )
            $( `#wrapper-file` ).html( "" );
        else {
            if( data.type == 0 )
                $( `#wrapper-file` ).html( "" );
            data.file.forEach( ( x ) => { addFile( null , x ); } );
            if( data.type == 0 )
                $( `#wrapper-file` ).find( "i.fas.fa-times" ).remove();
        }
    };
    verificar = ( t ) => {
        $( `#wrapper-file` ).html( "" );
        if( parseInt( $( t ).val() ) == 0 ) {
            $( "#descargas_image,#btnFile" ).closest( ".row" ).addClass( "d-none" );
            addFile( null );
            $( `#wrapper-file` ).find( "i.fas.fa-times" ).remove();
        } else {
            $( "#descargas_image,#btnFile" ).closest( ".row" ).removeClass( "d-none" );
        }
    };
    /** ------------------------------------- */
    addFile = ( t, value = null ) => {
        let target = $( `#wrapper-file` );
        let html = "";
        if( window[ `fileCount` ] === undefined ) window[ `fileCount` ] = 0;
        window[ `fileCount` ] ++;
        html += '<div class="col-12 col-md-6 mt-3 element">';
            html += '<div class="bg-light p-2 border overflow-hidden position-relative">';
                html += window.pyrus_parte.formulario( window[ `fileCount` ] , `file` );
                html += `<i style="line-height:14px; cursor: pointer; right: 0; top: 0; padding: 5px;border-radius: 0 0 0 .4em;" onclick="remove_( this , 'element' )" class="fas fa-times position-absolute text-white bg-danger"></i>`;
            html += '</div>';
        html += '</div>';
    
        target.append(html);
        
        window.pyrus_parte.show( null , url_simple , value , window[ `fileCount` ] , `file` );
    };
    /** -------------------------------------
     *      INICIO
     ** ------------------------------------- */
    init = ( callbackOK ) => {
        let form = window.pyrus.formulario();
        
        form += `<div class="row justify-content-center pt-3">`;
            form += `<div class="col-md-3 col-12">`;
                form += `<button id="btnFile" type="button" class="btn btn-block btn-dark text-center text-uppercase" onclick="addFile( this )">Archivo<i class="fas fa-plus ml-2"></i></button>`;
            form += `</div>`;
        form += `</div>`;
        form += `<div class="row mt-0" id="wrapper-file"></div>`;
        /** */
        $( "#form .modal-body" ).html( form );
        $( "#wrapper-tabla > div.card-body" ).html( window.pyrus.table( [ { NAME:"ACCIONES" , COLUMN: "acciones" , CLASS: "text-center" , WIDTH: "150px" } ] ) );
        
        window.pyrus.elements( $( "#tabla" ) , url_simple , window.data.elementos , [ 'e' , 'd' ] );
        
        callbackOK.call( this , null );
    };
    /** */
    init( () => {} );
</script>
@endpush