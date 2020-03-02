<section class="my-3">
    <div class="container-fluid">
        {{--<div class="wrapper-servicio py-4 bg-white mb-4">
            @include( 'page.parts.categorias' , [ 'categorias' => $data[ 'elementos' ] , 'link' => 0 ] )
        </div>--}}
        @include( 'layouts.general.form' , [ 'buttonADD' => 1 , 'form' => 0 , 'close' => 1 , 'modal' => 1 ] )
        
        @include( 'layouts.general.table' , [ 'paginate' => $data[ "elementos" ] ] )
    </div>
</section>
@push('scripts')
<script>
    window.pyrus = new Pyrus( "video" , null , src );
    
    init( () => {} );
</script>
@endpush