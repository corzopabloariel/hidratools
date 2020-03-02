<section class="my-3">
    <div class="container-fluid">
        @include( 'layouts.general.form' , [ 'buttonADD' => 1 , 'form' => 0 , 'close' => 1 , 'modal' => 1 ] )
        @include( 'layouts.general.table' , [ 'paginate' => $data[ "elementos" ] ] )
    </div>
</section>
@push('scripts')
<script>
    window.pyrus = new Pyrus( "subcategoria" , null , src );

    addfinish = ( data = null ) => {
        $( `#${window.pyrus.name}_categoria_id` ).val( window.data.categoria_id )
    };

    init( () => {} );
</script>
@endpush