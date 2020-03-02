<footer>
    <div class="container pb-2 pt-4 position-relative">
        <div class="row justify-content-start pt-3">
            <div class="col-12 col-md-6 col-lg-4 d-flex order-o-1">
                <img class="logo align-self-center" src="{{ asset($data['empresa']->images['logoFooter'][ 'i' ]) }}" alt="" srcset="">
            </div>
            <div class="col-12 col-md-6 col-lg order-o-3">
                <h3 class="title mb-2">Mapa del sitio</h3>
                <div class="d-flex">
                    <ul class="list-unstyled mb-0 menu">
                    @if(auth()->guard('client')->check())
                        <li><a href="{{ URL::to( 'cliente/descargas' ) }}">Descargas</a></li>
                        <li><a href="{{ URL::to( 'cliente/datos' ) }}">Mis datos</a></li>
                    @else
                        @foreach( $data[ "empresa" ]->sections AS $s )
                            <li><a href="{{ URL::to( $s[ 'LINK' ] ) }}">{{ $s[ 'NAME' ] }}</a></li>
                        @endforeach
                    @endif
                    </ul>
                </div>
            </div>
        </div>
        <hr>
        <div class="row justify-content-start">
            <div class="col-12 col-md-4 mt-0 col-lg">
                @include( 'layouts.general.domicilio' , [ "dato" => $data[ 'empresa' ]->domicile , "link" => 1 ] )
            </div>
            <div class="col-12 col-md-4 mt-0 col-lg">
                <ul class="list-unstyled info mb-0">
                    <li class="d-flex align-items-start">
                        <i class="fas fa-phone-volume"></i>
                        <div>
                            @foreach( $data[ "telefono" ] AS $t )
                                @include( 'layouts.general.telefono' , [ "dato" => $t ] )
                            @endforeach
                        </div>
                    </li>
                </ul>
            </div>
            @if( !empty( $data[ "whatsapp" ] ) )
                <div class="col-12 col-md-4 mt-0 col-lg">
                    <ul class="list-unstyled info mb-0">
                        <li class="d-flex align-items-start">
                            <i class="fab fa-whatsapp"></i>
                            <div>
                                <p>WhatsApp</p>
                                @foreach( $data[ "whatsapp" ] AS $t )
                                    @include( 'layouts.general.telefono' , [ "dato" => $t ] )
                                @endforeach
                            </div>
                        </li>
                    </ul>
                </div>
            @endif
            <div class="col-12 col-md-4 mt-0 col-lg">
                <ul class="list-unstyled info mb-0">
                    <li class="d-flex align-items-start">
                        <i class="far fa-envelope"></i>
                        <div>
                            <p>Escríbanos a</p>
                            @foreach( $data["empresa"]->email as $e )
                                @include( 'layouts.general.email' , [ "dato" => $e ] )
                            @endforeach
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-md-6 col-lg">
                <p>Seguinos en</p>
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
                <div class="d-flex social-networks ml-n2">
                    @foreach( $data[ "empresa" ]->social_networks AS $k => $red )
                    <a class="ml-2" href="{{ $red[ 'url' ] }}" target="_blank" rel="noopener noreferrer" title="{{ $red[ 'titulo' ] }}">{!! $social_networks[ $red[ 'redes' ] ] !!}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="osole py-3">
        <div class="container">
            <div class="row by">
                <div class="col-12">
                    <p class="mb-0 d-flex justify-content-between">
                        <span>© 2019</span>
                        <a target="_blank" href="{{ env('APP_UAUTHOR') }}" style="color:inherit" class="right text-uppercase">by {{ env('APP_AUTHOR') }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>