<div class="container">
    <h3 class="title text-uppercase mb-5">Seleccione un servicio</h3>
    <div class="row mt-n5">
        @foreach( $servicios AS $s )
        @php
        $url = URL::to( 'servicio/' . str_slug( $s->title ) . '/' . $s->id );
        if( !$link )
            $url = "#";
        @endphp
        <div class="col-12 col-md-4 d-flex align-items-stretch mt-5">
            <div class="card border-0 w-100 hover">
                <a href="{{ $url }}" class="d-block plus">
                    <div class="img">
                        @include( 'layouts.general.image' , [ 'i' => !empty( $s->image ) ? $s->image[ 0 ][ "image" ] : "" , 'c' => 'card-img-top' , 'n' => $s->title ] )
                    </div>
                    <div class="card-body border-0 p-0">
                        <h5 class="card-title d-flex justify-content-between text-dark p-2">{{ $s->title }}</h5>
                        <div class="card-text">{!! $s->resume !!}</div>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>