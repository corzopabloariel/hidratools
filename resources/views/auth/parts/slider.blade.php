<section class="my-3">
    <div class="container-fluid wrapper-{{ $data[ 'section' ] }}">
        @include( 'layouts.general.slider' , [ 'slider' => $data[ 'elementos' ] , 'sliderID' => "slider" , 'div' => 0 , 'arrow' => 0 ] )
        @include( 'layouts.general.form', [ 'buttonADD' => 1 , 'form' => 0 , 'close' => 1 , 'modal' => 1 ] )
        @include( 'layouts.general.table' )
    </div>
</section>
@push('scripts')
<script>
    window.pyrus = new Pyrus("slider", null, src);
    
    /** -------------------------------------
        Agrega o ejecuta algún evento después de la carga inicial
     ** ------------------------------------- */
    addfinish = () => {
        $( `#${window.pyrus.name}_section`).val( window.data.section );
    };
    /** -------------------------------------
     *      INICIO
     ** ------------------------------------- */
    init( () => {} );
</script>
@endpush