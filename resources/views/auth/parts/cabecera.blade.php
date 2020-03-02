<section class="my-3">
    <div class="container-fluid">
        <div class="alert alert-primary" role="alert">
            <h2 class="text-center">Imagen de cabecera de secciones</h2>
        </div>
        @foreach( $data[ "cabeceras" ] AS $k => $v )
        <div id="wrapper-form-{{ $k }}" class="mt-4">
            <div class="card">
                <div class="card-body">
                    <form id="form_{{ $k }}" onsubmit="event.preventDefault(); formSubmit(this , '{{ $k }}');" novalidate class="" action="{{ url('/adm/contenido/' . $k . '/update') }}" method="put" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <button class="btn btn-success px-5 text-uppercase d-block mx-auto mb-4">header <strong>{{ $v }}</strong><i class="fas fa-save ml-3"></i></button>
                        <div class="container-form-{{ $k }}"></div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@push('scripts')
<script>
    const src_large = "{{ asset('images/no-img-large.jpg') }}";

    formSubmit = ( t , tipo ) => {
        let idForm = t.id;
        let url = t.action;
        let method = t.method;
        let formElement = document.getElementById(idForm);
        if(method == "GET" || method == "get") method = "post";
        let formData = new FormData(formElement);
        
        formData.append("ATRIBUTOS",JSON.stringify(
            [
                { DATA: window[ `pyrus_${tipo}` ].objetoSimple, TIPO: "U" }
            ]
        ));

        formSave( t , formData );
    };
    /** ------------------------------------- */
    init = ( callbackOK ) => {
        for( let x in window.data.cabeceras ) {
            window[ `pyrus_${x}` ] = new Pyrus( `${x}` , null , src_large );
            $(`#form_${x} .container-form-${x}`).html(window[ `pyrus_${x}` ].formulario());
        }
        callbackOK.call(this,null);
    };
    /** */
    init( () => {
        for( let x in window.data.cabeceras ) {
            window[ `pyrus_${x}` ].show( null , url_simple , window.data.contenido[ x ].data );
        }
    });
</script>
@endpush