<section class="my-3">
    <div class="container-fluid">
        <div class="mb-4">
            @include( 'page.parts.home' , [ 'iconos' => $data[ 'elementos' ]->data ] )
        </div>
        @include( 'layouts.general.form', [ 'buttonADD' => 0 , 'form' => 1 , 'close' => 0 , 'url' => url('/adm/contenido/' . $data['section'] . '/update') , 'modal' => 0 ] )
    </div>
</section>
@push('scripts')
<script>
    window.pyrus_icono = new Pyrus("contenido_home_icono", null, src);
    window.pyrus_title = new Pyrus("contenido_home_title");

    window.ARR_pyrus = [ "pyrus_icono" , "pyrus_title", ];

    formSubmit = ( t ) => {
        let idForm = t.id;
        let formElement = document.getElementById( idForm );

        let formData = new FormData( formElement );
        formData.append( "ATRIBUTOS", JSON.stringify(
            [
                { DATA: window.pyrus_title.objetoSimple, TIPO: "U", COLUMN: "title" },
                { DATA: window.pyrus_icono.objetoSimple, TIPO: "M", COLUMN: "icono" , TAG : "icono" , KEY: "icono" }
            ]
        ));
        for( let x in CKEDITOR.instances )
            formData.set( x , CKEDITOR.instances[ `${x}` ].getData() );
        formSave( t , formData );
    };
    
    addIcono = ( t , value = null ) => {
        let target = $(`#wrapper-icono`);
        let html = "";
        if( window[ `icono` ] === undefined ) window[ `icono` ] = 0;
        window[ `icono` ] ++;

        html += '<div class="col-12 col-md-4 mt-3 icono">';
            html += '<div class="bg-light p-2 border position-relative overflow-hidden">';
                html += window.pyrus_icono.formulario( window[ `icono` ] , `icono` );
                html += `<i style="line-height:14px; cursor: pointer; right: 0; top: 0; padding: 5px;border-radius: 0 0 0 .4em;" onclick="remove_( this , 'icono' )" class="fas fa-times position-absolute text-white bg-danger"></i>`;
            html += '</div>';
        html += '</div>';

        target.append( html );
        window.pyrus_icono.editor( CKEDITOR , window[ `icono` ] , "icono" );
        window.pyrus_icono.show( CKEDITOR , url_simple , value , window[ `icono` ] , "icono" );
    };

    /** ------------------------------------- */
    init = ( callbackOK ) => {
        /** */
        let form = "";
        
        form += window.pyrus_title.formulario();

        form += `<div class="row justify-content-center pt-3">`;
            form += `<div class="col-md-6 col-12">`;
                form += `<button id="btnIcono" type="button" class="btn btn-block btn-dark text-center text-uppercase" onclick="addIcono( this )">Ícono (Título e Imágen)<i class="fas fa-plus ml-2"></i></button>`;
            form += `</div>`;
        form += `</div>`;
        form += `<div class="row mt-3n" id="wrapper-icono"></div>`;
        
        $("#form .container-form").html( form );
        
        window.pyrus_title.editor( CKEDITOR );
        callbackOK.call( this );
    };
    /** */
    init( () => {

        if( Object.keys( window.data.elementos.data ).length == 0 ) {
            addIcono( null );
        } else {
            window.pyrus_title.show( null , url_simple , window.data.elementos.data.title );
            
            if( Object.keys( window.data.elementos.data.icono ).length == 0 )
                addIcono( null );
            else
                window.data.elementos.data.icono.forEach( ( x ) => {
                    addIcono( null , x );
                } );
        }
    });
</script>
@endpush
