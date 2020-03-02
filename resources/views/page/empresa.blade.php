<div class="wrapper-empresa pb-5 bg-white">
    @include( 'layouts.general.slider' , [ 'slider' => $data[ 'slider' ] , 'sliderID' => "slider" , 'div' => 1 , 'arrow' => 0 ] )
    @include( 'page.parts.empresa' , [ 'elemento' => $data[ 'contenido' ]->data ] )
</div>