<section class="mY-3">
    <div class="container">
        <div class="mt-5 row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Usuario: {{$data["usuario"]["username"]}}</h5>
                        <form id="form" onsubmit="event.preventDefault(); formSubmit(this);" novalidate class="pt-2" action="{{ url('/adm/usuarios/update/' . $data['usuario']->id) }}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="usuarios_is_admin" value="{{ $data['usuario']->is_admin }}">
                            <input type="hidden" name="usuarios_username" value="{{ $data['usuario']->username }}">
                            
                            <div class="form-group">
                                <div class="form-label-group">
                                    <input value="{{$data['usuario']->name}}" required="true" maxlength="100" name="usuarios_name" id="usuarios_name" class="form-control  texto-text border-left-0 border-right-0 border-top-0 rounded-0 form-adm" type="text" placeholder="NOMBRE">
                                    <label for="usuarios_name" class="form-adm">NOMBRE</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-label-group">
                                    <input name="usuarios_password" id="usuarios_password" class="form-control texto-text border-left-0 border-right-0 border-top-0 rounded-0 form-adm" type="password" placeholder="CONTRASEÑA">
                                    <label for="usuarios_password" class="form-adm">CONTRASEÑA</label>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-block btn-success text-center text-uppercase"></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mt-3 alert alert-warning border-warning" role="alert">Si no desea cambiar la clave, deje el campo vacío.</div>
            </div>
        </div>
    </div>
</section>
@push( "scripts" )
<script>
    window.pyrus = new Pyrus("usuarios");
    formSubmit = function(t) {
        let idForm = t.id;
        let url = t.action;
        let method = t.method;
        let formElement = document.getElementById(idForm);
        if(method == "GET" || method == "get") method = "post";
        let formData = new FormData(formElement);
        formSave( t , formData , { wait : "Espere. Guardando contenido" , err: "Ocurrió un error en el proceso. Reintente" , catch: "Ocurrió un error en el proceso." , success : "Datos modificados correctamente" } );
    };
</script>
@endpush