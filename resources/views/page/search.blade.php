<div class="wrapper-productos bg-white pb-5">
    @include( 'layouts.general.image' , [ 'i' => $data[ 'cabecera' ]->data[ 'header' ] , 'c' => 'cabecera' , 'in_div' => 1 ] )
    <div class="container pt-3">
        <ol class="breadcrumb bg-transparent border-0 p-0">
            <li class="breadcrumb-item home"><a href="{{ URL::to( '/' ) }}"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Buscador</li>
        </ol>
        <div class="row mt-5 justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <form action="{{ URL::to('buscar') }}" class="wrapper-contacto" method="get">
                    <div class="row">
                        <div class="col-12 col-md-8 col-lg-9 col-xl-9">
                            <div class="form-group m-0 w-100">
                                <input required pattern=".{3,}" @if(!empty($data['search'])) value="{{$data['search']}}" @endif @end placeholder="Buscar productos por título, descripción o contenido en general" type="search" name="search" class="form-control">
                                <small class="form-text text-muted">Buscar productos por título, descripción o contenido en general</small>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-3 col-xl-3">
                            <button class="d-block btn-block btn btn-warning px-4 rounded-pill">Buscar<i class="fas fa-angle-right ml-2"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12 col-md">
                <div class="row mt-n4">
                    @forelse( $data[ "productos" ] AS $producto )
                        <div class="col-12 col-md-4 mt-4 hover">
                            <a href="{{ URL::to( 'producto/' . str_slug( $producto->title ) ) }}" class="d-block plus">
                                @if( $producto->is_nuevo )
                                    @include( 'layouts.general.image' , [ 'i' => "images/new.png" , 'c' => 'position-absolute new' , 'n' => 'Nuevo producto - ' . $producto->title ] )
                                @endif
                                <div class="img">
                                    @include( 'layouts.general.image' , [ 'i' => empty( $producto->images ) ? "" : $producto->images[0][ "image" ] , 'c' => 'img-producto w-100' , 'n' => $producto->title , 'in_div' => 1 ] )
                                </div>
                                <p class="name">{{ $producto->title }}</p>
                            </a>
                        </div>
                        @empty
                        <div class="col-12 py-5">
                            <p class="text-center">No se encontraron registros</p>
                        </div>
                    @endforelse
                </div>
                <div class="row mt-5">
                    <div class="col-12 d-flex justify-content-center">
                        @if(empty($data['search']))
                        {{ $data[ "productos" ]->links() }}
                        @else
                        {{ $data[ "productos" ]->appends(["search" => $data['search']])->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>