<div class="wrapper-videos">
    <h3 class="title text-center">Categorías</h3>
    <ul class="list-group wrapper-categorias">
        @foreach( $data[ "blog_categorias" ] AS $c )
        <li class="list-group-item border-0 d-flex justify-content-between"><a href="{{ URL::to( 'blogs/' . str_slug( $c->title ) . '/' . $c->id ) }}">{{ $c->title }}</a><span class="badge badge-pill badge-warning">{{ $c->blogs()->count() }}</span></li>
        @endforeach
    </ul>
</div>
<div class="wrapper-videos mt-5">
    <h3 class="title text-center">Últimos videos</h3>
    @foreach( $data[ "videos" ] AS $v )
        <div class="mt-4 row">
            <div class="col-12 col-md">
                <iframe class="w-100" src="https://www.youtube.com/embed/{{ $v->url }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <p class="mt-2">{{ $v->title }}</p>
            </div>
        </div>
    @endforeach
</div>
<div class="wrapper-redes mt-5">
    <h3 class="title text-center">Redes sociales</h3>
    @php
    $social_networks = [ 
        'instagram' => '<i class="fab fa-instagram"></i>',
        'linkedin' => '<i class="fab fa-linkedin-in"></i>',
        'youtube' => '<i class="fab fa-youtube"></i>',
        'facebook' => '<i class="fab fa-facebook-f"></i>',
        'twitter' => '<i class="fab fa-twitter"></i>',
        'pinterest' => '<i class="fab fa-pinterest-p"></i>'
    ];
    @endphp
    <div class="d-flex ml-n3 justify-content-center social-networks mt-4">
        @foreach( $data[ "empresa" ]->social_networks AS $k => $red )
        <a class="ml-3" href="{{ $red[ 'url' ] }}" target="_blank" rel="noopener noreferrer" title="{{ $red[ 'titulo' ] }}">{!! $social_networks[ $red[ 'redes' ] ] !!}</a>
        @endforeach
    </div>
</div>