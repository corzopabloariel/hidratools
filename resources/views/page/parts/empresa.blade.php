<div class="container py-5">
    <div class="row">
        <div class="col-12 col-md">
            @include( 'layouts.general.image' , [ 'i' => $elemento[ 'image' ] , 'c' => 'w-100 d-block' , 'n' => 'Imagen Empresa' ] )
        </div>
        <div class="col-12 col-md">
            <div class="title">{!! $elemento[ 'title' ] !!}</div>
            <div class="text mt-3">{!! $elemento[ 'text' ] !!}</div>
        </div>
    </div>
</div>