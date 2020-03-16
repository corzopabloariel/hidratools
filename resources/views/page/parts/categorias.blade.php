<div class="container">
    @if( isset( $text ) )
    <h3 class="title text-uppercase">{{ $text }}</h3>
    @else
    <h3 class="title text-uppercase">Seleccione una categoría</h3>
    @endif
    <div class="row mt-3">
        @foreach( $categorias AS $c )
        <div class="col-12 col-md-4">
            <div class="card border-0 hover bg-transparent">
                @php
                $href = "#";
                if( $link )
                    $href = URL::to( 'productos/' . str_slug( $c->title ) );
                @endphp
                <a href="{{ $href }}" class="d-block position-relative categoria plus">
                    <div class="img">
                        @include( 'layouts.general.image' , [ 'i' => $c->logo , 'c' => 'position-absolute logo' , 'n' => $c->title ] )
                        @include( 'layouts.general.image' , [ 'i' => $c->image , 'c' => 'card-img-top' , 'n' => $c->title ] )
                    </div>
                    <div class="card-body border-0 p-2">
                        <h5 class="card-title d-flex justify-content-between">{{ $c->title }}</h5>
                        <div class="card-text">{!! $c->resume !!}</div>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>