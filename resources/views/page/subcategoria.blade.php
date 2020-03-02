<div class="wrapper-productos bg-white pb-5">
    @include( 'layouts.general.image' , [ 'i' => $data[ 'cabecera' ]->data[ 'header' ] , 'c' => 'cabecera' , 'in_div' => 1 ] )
    <div class="container pt-3">
        <ol class="breadcrumb bg-transparent border-0 p-0">
            <li class="breadcrumb-item home"><a href="{{ URL::to( '/' ) }}"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ URL::to( 'productos' ) }}">Productos</a></li>
            <li class="breadcrumb-item"><a href="{{ URL::to( 'productos/' . str_slug( $data[ 'categoria' ]->title ) . '/' . $data[ 'categoria' ]->id ) }}">{{ $data[ 'categoria' ]->title }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $data[ 'subcategoria' ]->title }}</li>
        </ol>
        <div class="row mt-5">
            <div class="col-12 col-md-4 col-lg-3 menu-lateral pb-5">
                @include( 'page.parts.menu' )
            </div>
            <div class="col-12 col-md-8 col-lg-9">
                <div class="row mt-n4">
                    @foreach( $data[ "productos" ] AS $producto )
                        <div class="col-12 col-md-4 mt-4 hover">
                            <a href="{{ URL::to( 'producto/' . str_slug( $producto->title ) . '/' . $producto->id ) }}" class="d-block plus">
                                @if( $producto->is_nuevo )
                                    @include( 'layouts.general.image' , [ 'i' => "images/new.png" , 'c' => 'position-absolute new' , 'n' => 'Nuevo producto - ' . $producto->title ] )
                                @endif
                                <div class="img">
                                    @include( 'layouts.general.image' , [ 'i' => empty( $producto->images ) ? "" : $producto->images[0][ "image" ] , 'c' => 'img-producto w-100' , 'n' => $producto->title , 'in_div' => 1 ] )
                                </div>
                                <p class="name">{{ $producto->title }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="row mt-5">
                    <div class="col-12 d-flex justify-content-center">
                        {{ $data[ "productos" ]->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>