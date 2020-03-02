<section class="my-3">
    <div class="container-fluid">
        @include( 'layouts.general.form' , [ 'buttonADD' => 1 , 'form' => 1 , 'close' => 1 , 'modal' => 1 , "buttons" => [ [ "i" => "fab fa-elementor" , "t" => "Categorías" , "b" => "btn-primary" , "f" => "categorias" ] ] ])
        
        @include( 'layouts.general.table' , [ 'paginate' => $data[ "elementos" ] ] )
    </div>
</section>
@push('scripts')
<script>
    window.pyrus = new Pyrus( "blog" , { category_id : { DATA : window.data.categorias } } , src );
    window.pyrus_image = new Pyrus( "blog_images" , null , src );
    categoriasFunction = ( t ) => {
        window.location = `${url_simple}/adm/blog/categorias`;
    };
    
    formSubmit = ( t ) => {
        let idForm = t.id;
        let formElement = document.getElementById( idForm );

        let formData = new FormData( formElement );
        formData.append( "ATRIBUTOS", JSON.stringify(
            [
                { DATA: window.pyrus.objetoSimple, TIPO: "U" },
                { DATA: window.pyrus_image.objetoSimple, TIPO: "M", COLUMN: "image" , TAG : "image" , KEY: "image" },
            ]
        ));
        for( let x in CKEDITOR.instances )
            formData.set( x , CKEDITOR.instances[ `${x}` ].getData() );
        formSave( t , formData );
    };
    
    addImagen = ( t , value = null ) => {
        let target = $(`#wrapper-imagen`);
        let html = "";
        if( window[ `image_count` ] === undefined ) window[ `image_count` ] = 0;
        window[ `image_count` ] ++;

        html += '<div class="col-12 col-md-6 mt-3 image_count">';
            html += '<div class="bg-light p-2 border position-relative overflow-hidden">';
                html += window.pyrus_image.formulario( window[ `image_count` ] , `image` );
                html += `<i style="line-height:14px; cursor: pointer; right: 0; top: 0; padding: 5px;border-radius: 0 0 0 .4em;" onclick="remove_( this , 'image_count' )" class="fas fa-times position-absolute text-white bg-danger"></i>`;
            html += '</div>';
        html += '</div>';

        target.append( html );
        window.pyrus_image.show( CKEDITOR , url_simple , value , window.image_count , "image" );
    };

    addfinish = ( data = null ) => {
        document.getElementById( "wrapper-imagen" ).innerHTML = "";
        if( data !== null )
            data.image.forEach( ( x ) => { addImagen( null , x ); } );
    };
    /** -------------------------------------
     *      INICIO
     ** ------------------------------------- */

    init = ( callbackOK , table = true , type = "table" , without = false ) => {
        /** */
        let h = window.pyrus.formulario();
        h += `<fieldset class="border p-3 mt-3">`;
            h += `<div class="row justify-content-center">`;
                h += `<div class="col-md-6 col-12">`;
                    h += `<button id="btnIcono" type="button" class="btn btn-block btn-dark text-center text-uppercase" onclick="addImagen( this )">Agregar imagen<i class="fas fa-plus ml-2"></i></button>`;
                h += `</div>`;
            h += `</div>`;
            h += `<div class="row mt-3n" id="wrapper-imagen"></div>`;
        h += `</fieldset>`;

        $( "#form .modal-body" ).html( h );
        $( "#wrapper-tabla > div.card-body" ).html( window.pyrus.table( [ { NAME:"ACCIONES" , COLUMN: "acciones" , CLASS: "text-center" , WIDTH: "150px" } ] ) );
        
        window.pyrus.editor( CKEDITOR );
        window.pyrus.elements( $( "#tabla" ) , url_simple , window.data.elementos , [ "e" , "d" ] );
        
        callbackOK.call( this , null );
    };
    
    init( () => {} );
</script>
@endpush