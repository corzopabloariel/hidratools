<section class="my-3">
    <div class="container-fluid">
        @include( 'layouts.general.form' , [ 'buttonADD' => 1 , 'form' => 0 , 'close' => 1 , 'modal' => 1 ] )
        <form action="" method="get" class="my-3 border p-4 bg-white d-flex">
            <input required @isset( $data[ 'search' ] ) value="{{ $data[ 'search' ] }}" @endisset type="search" name="search" placeholder="Buscador general" class="form-control">
            <button type="submit" class="btn btn-primary px-3"><i class="fas fa-search"></i></button>
        </form>
        @include( 'layouts.general.table' , [ 'paginate' => $data[ "elementos" ] ] )
    </div>
</section>
@push('scripts')
<script>
    window.pyrus = new Pyrus( "producto" , { categoria_id: { DATA : window.data.categorias } } , src );
    window.pyrusImages = new Pyrus( "producto_images" , null , src );
    window.pyrusCaracteristica = new Pyrus( "producto_caracteristicas" , null , src );
    window.pyrusPlano = new Pyrus( "producto_planos" , null , src );
    window.pyrusAccesorio = new Pyrus( "producto_accesorios" , null , src );
    
    addfinish = ( data = null ) => {
        if( data !== null ) {
            if( data.images !== null )
                data.images.forEach( ( x ) => { addImages( null , x ) } );
            if( data.caracteristicas !== null )
                data.caracteristicas.forEach( ( x ) => { addCaracteristica( null , x ) } );
            if( data.planos !== null )
                data.planos.forEach( ( x ) => { addPlano( null , x ) } );
            if( data.accesorios !== null )
                data.accesorios.forEach( ( x ) => { addAccesorio( null , x ) } );
        } else 
            $( "#wrapper-images,#wrapper-caracteristicas,#wrapper-plano,#wrapper-accesorio" ).html( "" );
    };
    formSubmit = ( t ) => {
        let idForm = t.id;
        let formElement = document.getElementById( idForm );

        let formData = new FormData( formElement );
        formData.append( "ATRIBUTOS", JSON.stringify(
            [
                { DATA: window.pyrus.objetoSimple, TIPO: "U" },
                { DATA: window.pyrusImages.objetoSimple, TIPO: "M", COLUMN: "images" , TAG : "images" , KEY: "images" },
                { DATA: window.pyrusCaracteristica.objetoSimple, TIPO: "M", COLUMN: "caracteristicas" , TAG : "caracteristicas" , KEY: "caracteristicas" },
                { DATA: window.pyrusPlano.objetoSimple, TIPO: "M", COLUMN: "planos" , TAG : "planos" , KEY: "planos" },
                { DATA: window.pyrusAccesorio.objetoSimple, TIPO: "M", COLUMN: "accesorios" , TAG : "accesorios" , KEY: "accesorios" }
            ]
        ));
        for( let x in CKEDITOR.instances )
            formData.set( x , CKEDITOR.instances[ `${x}` ].getData() );
        formSave( t , formData );
    };
    /** ------------------------------------- */
    addCaracteristica = ( t, value = null ) => {
        let target = $( `#wrapper-caracteristicas` );
        let html = "";
        if( window[ `caracteristicaCount` ] === undefined ) window[ `caracteristicaCount` ] = 0;
        window[ `caracteristicaCount` ] ++;
        html += '<div class="col-12 col-md-6 mt-3 element">';
            html += '<div class="bg-light p-2 border overflow-hidden position-relative">';
                html += window.pyrusCaracteristica.formulario( window[ `caracteristicaCount` ] , `caracteristicas` );
                html += `<i style="line-height:14px; cursor: pointer; right: 0; top: 0; padding: 5px;border-radius: 0 0 0 .4em;" onclick="remove_( this , 'element' )" class="fas fa-times position-absolute text-white bg-danger"></i>`;
            html += '</div>';
        html += '</div>';
    
        target.append(html);
        window.pyrusCaracteristica.editor( CKEDITOR , window[ `caracteristicaCount` ] , "caracteristicas" );
        window.pyrusCaracteristica.show( CKEDITOR , url_simple , value , window[ `caracteristicaCount` ] , `caracteristicas` );
    };
    /** ------------------------------------- */
    addImages = ( t, value = null ) => {
        let target = $( `#wrapper-images` );
        let html = "";
        if( window[ `imagesCount` ] === undefined ) window[ `imagesCount` ] = 0;
        window[ `imagesCount` ] ++;
        html += '<div class="col-12 col-md-6 mt-3 element">';
            html += '<div class="bg-light p-2 border overflow-hidden position-relative">';
                html += window.pyrusImages.formulario( window[ `imagesCount` ] , `images` );
                html += `<i style="line-height:14px; cursor: pointer; right: 0; top: 0; padding: 5px;border-radius: 0 0 0 .4em;" onclick="remove_( this , 'element' )" class="fas fa-times position-absolute text-white bg-danger"></i>`;
            html += '</div>';
        html += '</div>';
    
        target.append(html);
        window.pyrusImages.editor( CKEDITOR , window[ `imagesCount` ] , "images" );
        window.pyrusImages.show( CKEDITOR , url_simple , value , window[ `imagesCount` ] , `images` );
    };
    addAccesorio = ( t, value = null ) => {
        let target = $( `#wrapper-accesorio` );
        let html = "";
        if( window[ `accesorioCount` ] === undefined ) window[ `accesorioCount` ] = 0;
        window[ `accesorioCount` ] ++;
        html += '<div class="col-12 col-md-6 mt-3 element">';
            html += '<div class="bg-light p-2 border overflow-hidden position-relative">';
                html += window.pyrusAccesorio.formulario( window[ `accesorioCount` ] , `accesorios` );
                html += `<i style="line-height:14px; cursor: pointer; right: 0; top: 0; padding: 5px;border-radius: 0 0 0 .4em;" onclick="remove_( this , 'element' )" class="fas fa-times position-absolute text-white bg-danger"></i>`;
            html += '</div>';
        html += '</div>';
    
        target.append(html);
        window.pyrusAccesorio.editor( CKEDITOR , window[ `accesorioCount` ] , "accesorios" );
        window.pyrusAccesorio.show( CKEDITOR , url_simple , value , window[ `accesorioCount` ] , `accesorios` );
    };
    addPlano = ( t, value = null ) => {
        let target = $( `#wrapper-plano` );
        let html = "";
        if( window[ `planoCount` ] === undefined ) window[ `planoCount` ] = 0;
        window[ `planoCount` ] ++;
        html += '<div class="col-12 col-md-6 mt-3 element">';
            html += '<div class="bg-light p-2 border overflow-hidden position-relative">';
                html += window.pyrusPlano.formulario( window[ `planoCount` ] , `planos` );
                html += `<i style="line-height:14px; cursor: pointer; right: 0; top: 0; padding: 5px;border-radius: 0 0 0 .4em;" onclick="remove_( this , 'element' )" class="fas fa-times position-absolute text-white bg-danger"></i>`;
            html += '</div>';
        html += '</div>';
    
        target.append(html);
        window.pyrusPlano.editor( CKEDITOR , window[ `planoCount` ] , "planos" );
        window.pyrusPlano.show( CKEDITOR , url_simple , value , window[ `planoCount` ] , `planos` );
    };
    addCabecera = ( t, value = null ) => {
        let target = $( `#wrapper-cabecera` );
        let html = "";
        if( window[ `cabeceraCount` ] === undefined ) window[ `cabeceraCount` ] = 0;
        window[ `cabeceraCount` ] ++;
        html += '<div class="col-12 col-md-6 mt-3 element">';
            html += '<div class="bg-light p-2 border overflow-hidden position-relative">';
                html += window.pyrusCabecera.formulario( window[ `cabeceraCount` ] , `cabecera` );
                html += `<i style="line-height:14px; cursor: pointer; right: 0; top: 0; padding: 5px;border-radius: 0 0 0 .4em;" onclick="remove_( this , 'element' )" class="fas fa-times position-absolute text-white bg-danger"></i>`;
            html += '</div>';
        html += '</div>';
    
        target.append(html);
        window.pyrusCabecera.editor( CKEDITOR , window[ `cabeceraCount` ] , "cabecera" );
        window.pyrusCabecera.show( CKEDITOR , url_simple , value , window[ `cabeceraCount` ] , `cabecera` );
    };

    init( () => {
        form = `<div class="row justify-content-center">`;
            form += `<div class="col-md-3 col-12">`;
                form += `<button id="btnImages" type="button" class="btn btn-block btn-dark text-center text-uppercase" onclick="addImages( this )">Imagen<i class="fas fa-plus ml-2"></i></button>`;
            form += `</div>`;
        form += `</div>`;
        form += `<div class="row mt-0" id="wrapper-images"></div>`;
        $( "#images-target" ).html( form );

        form = `<div class="row justify-content-center pt-3">`;
            form += `<div class="col-md-3 col-12">`;
                form += `<button id="btnCaracteristica" type="button" class="btn btn-block btn-dark text-center text-uppercase" onclick="addCaracteristica( this )">Característica<i class="fas fa-plus ml-2"></i></button>`;
            form += `</div>`;
        form += `</div>`;
        form += `<div class="row mt-0" id="wrapper-caracteristicas"></div>`;
        $( "#caracteristicas-target" ).html( form );
        
        form = `<div class="row justify-content-center pt-3">`;
            form += `<div class="col-md-3 col-12">`;
                form += `<button id="btnPlano" type="button" class="btn btn-block btn-dark text-center text-uppercase" onclick="addPlano( this )">Plano<i class="fas fa-plus ml-2"></i></button>`;
            form += `</div>`;
        form += `</div>`;
        form += `<div class="row mt-0" id="wrapper-plano"></div>`;
        $( "#planos-target" ).html( form );

        form = `<div class="row justify-content-center pt-3">`;
            form += `<div class="col-md-3 col-12">`;
                form += `<button id="btnAccesorio" type="button" class="btn btn-block btn-dark text-center text-uppercase" onclick="addAccesorio( this )">Accesorio<i class="fas fa-plus ml-2"></i></button>`;
            form += `</div>`;
        form += `</div>`;
        form += `<div class="row mt-0" id="wrapper-accesorio"></div>`;
        $( "#accesorios-target" ).html( form );
    } );
</script>
@endpush