<div class="wrapper-presupuesto pb-5 bg-white">
    @include( 'layouts.general.image' , [ 'i' => $data[ 'cabecera' ]->data[ 'header' ] , 'c' => 'cabecera' , 'in_div' => 1 , 'text' => 'SOLICITAR PRESUPUESTO' ] )
    <div class="mt-5 container py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-7">
                <div class="alert alert-primary d-none" id="notificacion"></div>
                <form novalidate onsubmit="event.preventDefault(); enviar(this)" id="form" action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="elementos[nombre]" value="Nombre">
                    <input type="hidden" name="elementos[email]" value="Email">
                    <input type="hidden" name="elementos[telefono]" value="Teléfono">
                    <input type="hidden" name="elementos[empresa]" value="Empresa">
                    <input type="hidden" name="elementos[mensaje]" value="Mensaje">
                    @csrf
                    <div class="row justify-content-md-center">
                        <div class="col-md-8 col-12 d-flex justify-content-center align-items-center">
                            <div>
                                <span class="img-1"></span>
                            </div>
                            <span class="linea w-50 mx-4"></span>
                            <div>
                                <span class="img-2 inactivo"></span>
                            </div>
                        </div>
                    </div>
                    <div id="primero" class="mt-5">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <input type="text" name="nombre" id="nombre" placeholder="Nombre (*)" class="form-control" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="email" name="email" id="email" placeholder="Correo electrónico (*)" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-md-6">
                                <input type="text" name="telefono" placeholder="Teléfono" class="form-control">
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" name="empresa" placeholder="Empresa" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-12 d-flex justify-content-end">
                                <button onclick="siguiente(this,1)" type="button" class="btn btn-warning rounded-pill px-4 btn-primary text-uppercase">siguiente</button>
                            </div>
                        </div>
                    </div>
                    <div id="segundo" class="mt-5" style="display:none">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <textarea name="mensaje" placeholder="Mensaje" row="4" class="form-control"></textarea>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input required type="file" accept="image/jpeg,application/pdf" value="" name="file" class="custom-file-input" id="file">
                                        <label data-invalid="Buscar archivo" data-valid="Archivo cargado" class="custom-file-label mb-0 text-truncate" data-browse="..." for="file"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-12 d-flex justify-content-end">
                                <button onclick="siguiente(this,0)" type="button" class="btn px-4 btn-outline-warning rounded-pill text-uppercase">volver</button>
                                <button type="submit" class="btn btn-warning rounded-pill text-uppercase px-4 ml-2">enviar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script src="https://www.google.com/recaptcha/api.js?render={{ $data[ 'empresa' ]->captcha[ 'public' ] }}"></script>
<script>
    enviar = function(t) {
        if($("#primero").is(":visible")) {
            siguiente(this,1);
            return false;
        }
        
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
                    if( parseInt( res.data.estado ) ) {
                        Toast.fire({
                            icon: 'success',
                            title: res.data.mssg
                        });
                        location.reload();
                    } else {
                        $( ".form-control" ).prop( "readonly" , false );
                        Toast.fire({
                            icon: 'error',
                            title: res.data.mssg
                        });
                    }
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
    siguiente = function(t,tt) {
        if(tt) {
            if( $("#nombre").val() == "" || $("#email").val() == "" ) {
                Toast.fire({
                    icon: 'error',
                    title: 'Complete Nombre y Correo elctrónico'
                });
                return false;
            }
            if( !$("#email").is(":valid") ) {
                Toast.fire({
                    icon: 'error',
                    title: 'Correo elctrónico no válido'
                });
                return false;
            }
            $("#primero").hide();
            $("#segundo").show();
            $('.img-1').addClass("inactivo");
            $('.img-2').removeClass("inactivo");
        } else {
            $("#primero").show();
            $("#segundo").hide();
            $('.img-1').removeClass("inactivo");
            $('.img-2').addClass("inactivo");
        }
    };
</script>
@endpush