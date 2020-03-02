<div class="wrapper-productos bg-white pb-5">
    @include( 'layouts.general.image' , [ 'i' => $data[ 'cabecera' ]->data[ 'header' ] , 'c' => 'cabecera' , 'in_div' => 1 ] )
    <div class="wrapper-servicio wrapper-categoria py-4 bg-white mb-4">
        @include( 'page.parts.categorias' , [ 'categorias' => $data[ 'categorias' ] , 'link' => 1 ] )
    </div>
</div>