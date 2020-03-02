<div class="wrapper-videos bg-white pb-5">
    @include( 'layouts.general.image' , [ 'i' => $data[ 'cabecera' ]->data[ 'header' ] , 'c' => 'cabecera' , 'in_div' => 1 , 'text' => 'VIDEOS' ] )
    <div class="container py-5">
        <h3 class="title text-uppercase">VIDEOS EXPLICATIVOS</h3>
        <div class="row">
            @foreach( $data[ "videos" ] AS $v )
            <div class="col-12 col-md-4 mt-3">
                <iframe class="w-100" src="https://www.youtube.com/embed/{{ $v->url }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <p class="p-2 mt-n2">{{ $v->title }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>