<div class="wrapper-servicio pb-5 bg-white">
    @include( 'layouts.general.image' , [ 'i' => $data[ 'cabecera' ]->data[ 'header' ] , 'c' => 'cabecera' , 'in_div' => 1 , 'text' => 'SERVICIOS' ] )
    <div class="mt-5">
        @include( 'page.parts.servicios' , [ 'servicios' => $data[ 'servicios' ] , 'link' => 1 ] )
    </div>
</div>