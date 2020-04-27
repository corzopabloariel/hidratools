<div class="wrapper-home bg-white">
    @include( 'layouts.general.slider' , [ 'slider' => $data[ 'slider' ] , 'sliderID' => "slider" , 'div' => 1 , 'arrow' => 0 ] )
    @if( $data[ "productos" ]->isNotEmpty() )
    <div class="pb-5 pt-4 destacado wrapper-productos bg-white">
        <div class="wrapper-videos container">
            <h3 class="title mb-3 text-uppercase">Productos destacados</h3>
            <div class="mt-n4" id="productos-slick">
                @foreach( $data[ "productos" ] AS $producto )
                    <div class="mt-4 hover p-3">
                        <a href="{{ URL::to( 'producto/' . str_slug( $producto->title ) ) }}" class="d-block plus position-relative">
                            @if( !empty( $producto->is_nuevo ) )
                                @include( 'layouts.general.image' , [ 'i' => "images/new.png" , 'c' => 'position-absolute new' , 'n' => 'Nuevo producto - ' . $producto->title ] )
                            @endif
                            <div class="img">
                                @include( 'layouts.general.image' , [ 'i' => empty( $producto->images ) ? "" : $producto->images[0][ "image" ] , 'c' => 'img-producto w-100' , 'n' => $producto->title , 'in_div' => 1 ] )
                            </div>
                            <p class="subname">{{ $producto->categoria->title }}</p>
                            <p class="name">{{ $producto->title }}</p>
                        </a>
                    </div>
                @endforeach
                @foreach( $data[ "categoriasD" ] AS $producto )
                    <div class="mt-4 hover p-3">
                        <a href="{{ URL::to( 'productos/' . str_slug( $producto->categoria->title ) . '/' . str_slug( $producto->title ) ) }}" class="d-block plus">
                            <div class="img">
                                @include( 'layouts.general.image' , [ 'i' => $producto->image , 'c' => 'img-producto w-100' , 'n' => $producto->title , 'in_div' => 1 ] )
                            </div>
                            <p class="subname">{{ $producto->categoria->title }}</p>
                            <p class="name">{{ $producto->title }}</p>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    <div class="wrapper-servicio wrapper-categoria py-3 bg-dark">
        @include( 'page.parts.categorias' , [ 'categorias' => $data[ 'categorias' ] , 'link' => 1 , 'text' => 'Línea de productos' ] )
    </div>
    <div class="wrapper-blogs">
        <div class="container">
            <div class="row pt-4 pb-5">
                <div class="col-12 col-md">
                    <div class="wrapper-videos">
                        <h3 class="title mb-3 text-uppercase">Últimas novedades</h3>
                        <div class="row wrapper-blog mt-n5">
                            @foreach( $data[ "blogs" ] AS $b )
                            <div class="hover col-12 col-md-4 mt-5">
                                @include( 'page.parts.blog' , [ 'elemento' => $b , 'type' => 1 ] )
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        @include( 'page.parts.home' , [ 'iconos' => $data[ 'contenido' ]->data ] )
    </div>
</div>
@push( "scripts" )
<script>
    init = () => {
        $('#productos-slick').slick({
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 4,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    };
    
    init();
</script>
@endpush