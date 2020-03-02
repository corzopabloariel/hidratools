<div class="wrapper-home">
    <div class="wrapper-icono py-5 bg-white">
        <div class="container">
            <div class="title mb-5">{!! $iconos[ 'title' ][ 'text' ] !!}</div>
            <div class="row justify-content-center">
                <div class="col-12 col-md-10">
                    <div class="row mt-3n justify-content-center">
                        @for( $i = 0 ; $i < count( $iconos[ 'icono' ] ) ; $i ++ )
                        <div class="col-12 mt-3 col-md-6 col-lg-4 d-flex justify-content-center iconos">
                            <div class="d-flex py-4">
                                @include( 'layouts.general.image' , [ 'i' => $iconos[ 'icono' ][ $i ][ 'image' ] , 'n' => 'Ícono #' . $i ] )
                                <div class="ml-4">{!! $iconos[ 'icono' ][ $i ][ 'text' ] !!}</div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>