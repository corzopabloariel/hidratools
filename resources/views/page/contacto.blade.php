<div class="wrapper-contacto bg-white pb-5">
    @include( 'layouts.general.image' , [ 'i' => $data[ 'cabecera' ]->data[ 'header' ] , 'c' => 'cabecera' , 'in_div' => 1 ] )
    <div class="mapa">
        {!! $data[ "empresa" ]->domicile[ "mapa" ] !!}
    </div>
    <div class="container pb-5 pt-3">
        <h2 class="title text-uppercase mb-4">contacto</h2>
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="info">
                    <div class="text mb-4">{!! $data[ "empresa" ]->text[ "text_contact" ] !!}</div>
                    <div class="d-flex">
                        <div class="icono">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="mb-1 text-uppercase">dirección</h3>
                            @include( 'layouts.general.domicilio' , [ "dato" => $data[ 'empresa' ]->domicile , "link" => 0 ] )
                        </div>
                    </div>
                    <div class="d-flex mt-4">
                        <div class="icono">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="mb-1 text-uppercase">teléfonos</h3>
                            @foreach( $data[ "telefono" ] AS $t )
                                <p>@include( 'layouts.general.telefono' , [ "dato" => $t ] )</p>
                            @endforeach
                        </div>
                    </div>
                    @if( !empty( $data[ "fax" ] ) )
                    <div class="d-flex mt-4">
                        <div class="icono">
                            <i class="fas fa-fax"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="mb-1 text-uppercase">FAX</h3>
                            @foreach( $data[ "fax" ] AS $t )
                                <p>@include( 'layouts.general.telefono' , [ "dato" => $t ] )</p>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @if( !empty( $data[ "whatsapp" ] ) )
                    <div class="d-flex mt-4">
                        <div class="icono">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="mb-1 text-uppercase">whatsapp</h3>
                            @foreach( $data[ "whatsapp" ] AS $t )
                                <p>@include( 'layouts.general.telefono' , [ "dato" => $t ] )</p>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    <div class="mt-4 d-flex">
                        <div class="icono">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="mb-1 text-uppercase">escribanos a</h3>
                            @foreach( $data["empresa"]->email as $e )
                                <p>@include( 'layouts.general.email' , [ "dato" => $e ] )</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md">
                <form action="" id="formContacto" onsubmit="event.preventDefault(); enviar( this )" method="post">
                    <input type="hidden" name="elementos[producto]" value="Producto">
                    <input type="hidden" name="elementos[servicio]" value="Servicio">
                    <input type="hidden" name="elementos[nombre]" value="Nombre">
                    <input type="hidden" name="elementos[email]" value="Email">
                    <input type="hidden" name="elementos[telefono]" value="Teléfono">
                    <input type="hidden" name="elementos[empresa]" value="Empresa">
                    <input type="hidden" name="elementos[mensaje]" value="Mensaje">
                    @isset( $data[ "producto" ] )
                    @php
                    $producto = $data[ 'producto' ]->full_name();
                    @endphp
                    <div class="d-flex align-items-center mb-3">
                        <label class="mr-2 mb-0">Producto a consultar: <strong>{{ $producto }}</strong></label>
                        <input type="hidden" name="producto" value="{{ $producto }}"/>
                    </div>
                    @endisset
                    @isset( $data[ "servicio" ] )
                    @php
                    $servicio = $data[ 'servicio' ]->title;
                    @endphp
                    <div class="d-flex align-items-center mb-3">
                        <label class="mr-2 mb-0">Servicio a consultar: <strong>{{ $servicio }}</strong></label>
                        <input type="hidden" name="servicio" value="{{ $servicio }}"/>
                    </div>
                    @endisset

                    @csrf
                    <div class="row">
                        <div class="col-12 col-md">
                            <input placeholder="Ingrese Nombre (*)" required type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre') }}">
                        </div>
                        <div class="col-12 col-md">
                            <input placeholder="Ingrese Correo electrónico (*)" required type="email" id="email" name="email" class="form-control" value="{{ old('nombre') }}">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12 col-md">
                            <input placeholder="Ingrese Teléfono" type="phone" id="telefono" name="telefono" class="form-control" value="{{ old('telefono') }}">
                        </div>
                        <div class="col-12 col-md">
                            <input placeholder="Ingrese Empresa" type="text" id="empresa" name="empresa" class="form-control" value="{{ old('empresa') }}">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12">
                            <textarea rows="10" placeholder="Escriba su mensaje (*)" required id="mensaje" name="mensaje" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 d-flex justify-content-end">
                            <button class="btn btn-warning px-4 rounded-pill">Enviar<i class="fas fa-angle-right ml-2"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push( "scripts" )
<script src="https://www.google.com/recaptcha/api.js?render={{ $data[ 'empresa' ]->captcha[ 'public' ] }}"></script>
<script>
    enviar = ( t ) => {
        let url = t.action;
        let method = t.method;
        let idForm = t.id;
        let formElement = document.getElementById( idForm );
        let formData = new FormData( formElement );
        grecaptcha.ready(function() {
            $( ".form-control" ).prop( "readonly" , true );
            Toast.fire({
                icon: 'warning',
                title: 'Espere, enviando'
            });
            grecaptcha.execute("{{ $data[ 'empresa' ]->captcha[ 'public' ] }}", {action: 'contact'}).then( function( token ) {
                formData.append( "token", token );
                axios({
                    method: method,
                    url: url,
                    data: formData,
                    responseType: 'json',
                    config: { headers: {'Content-Type': 'multipart/form-data' }}
                })
                .then((res) => {
                    $( ".form-control" ).prop( "readonly" , false );
                    if( parseInt( res.data.estado ) ) {
                        $( ".form-control" ).val( "" );
                        Toast.fire({
                            icon: 'success',
                            title: res.data.mssg
                        });
                    } else
                        Toast.fire({
                            icon: 'error',
                            title: res.data.mssg
                        });
                })
                .catch((err) => {
                    Toast.fire({
                        icon: 'error',
                        title: 'Ocurrió un error'
                    });
                })
                .then(() => {});
            });
        });
    };
</script>
@endpush