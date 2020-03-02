<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{ $data['metadato']['description'] }}"/>
        <meta name=”keywords” content="{{ $data['metadato']['keywords'] }}"/>
        <title>@yield( 'headTitle' , config( 'app.name' ) . ' :: ' . $data[ 'title' ] )</title>
        @if( !empty( $data[ "empresa" ][ "images" ][ "favicon" ] ) )
            @switch( $data[ "empresa" ][ "images" ][ "favicon" ][ "i" ] )
                @case("png")
                    <link rel="icon" type="image/png" href="{{ asset($data[ 'empresa' ]->images[ 'favicon' ][ 'i' ] ) }}" />
                    @break
                @case("svg")
                    <link rel="icon" href="{{ asset($data[ 'empresa' ]->images[ 'favicon' ][ 'i' ] ) }}" type="image/svg+xml" />
                    @break
                @default
                    <link rel="shortcut icon" href="{{ asset( $data[ 'empresa' ]->images[ 'favicon' ][ 'i' ] ) }}" />
            @endswitch
        @endif
        <!-- <Styles> -->
        @include( 'layouts.general.css' )
        <link rel="stylesheet" href="{{ asset('css/loading.css') }}">
        <link rel="stylesheet" href="{{ asset('css/loading-btn.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
        <link href="{{ asset('css/css.css') }}" rel="stylesheet">
        <link href="{{ asset('css/page/page.css') }}" rel="stylesheet">
        <link href="{{ asset('css/page/header.css') }}" rel="stylesheet">
        <link href="{{ asset('css/page/footer.css') }}" rel="stylesheet">
        @stack( 'styles' )
        <!-- </Styles> -->
    </head>
    <body>
        <div class="modal fade bd-example-modal-lg" id="terminosModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title">{{ $data[ "terminos" ]->contents[ "title" ] }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {!! $data[ "terminos" ]->contents[ "text" ] !!}
                    </div>
                </div>
            </div>
        </div>
        <div id="wrapper-menu" class="position-fixed">
            <div id="hamburger-" class="hamburger position-absolute open d-none" style="right: 10px; top: 10px; z-index:111; height: 40px" onclick="menuBody( this );">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="container py-0">
                @php
                $url = URL::to('/');
                if(auth()->guard('client')->check())
                    $url = URL::to('cliente/descargas');
                @endphp
                <a href="{{ $url }}">
                    <img onError="this.src='{{ asset('images/general/no-img.png') }}'" src="{{ asset($data['empresa']->images['logo']['i']) }}?t=<?php echo time(); ?>" />
                </a>
            </div>
            <div class="container">
                <ul class="list-group list-group-flush mb-0 bg-transparent">
                @if(auth()->guard('client')->check())
                    @php
                    $flag = false;
                    if( Request::is( "cliente/descarga*" ) )
                        $flag = true;
                    @endphp
                    <li class="list-group-item border-0 bg-transparent"><a @if( $flag ) class="active" @endif href="{{ URL::to( 'cliente/descargas' ) }}">Descargas</a></li>
                    @php
                    $flag = false;
                    if( Request::is( "cliente/datos*" ) )
                        $flag = true;
                    @endphp
                    <li class="list-group-item border-0 bg-transparent"><a @if( $flag ) class="active" @endif href="{{ URL::to( 'cliente/datos' ) }}">Mis datos</a></li>
                @else
                    @foreach( $data[ "empresa" ]->sections AS $s )
                        @php
                        $flag = false;
                        for( $i = 0 ; $i < count( $s[ "REQUEST" ] ) ; $i++ ) {
                            if( Request::is( "{$s[ 'LINK' ][ $i ]}*" ) )
                                $flag = true;
                        }
                        @endphp
                        <li class="list-group-item border-0 bg-transparent"><a @if( $flag ) class="active" @endif href="{{ URL::to( $s[ 'LINK' ] ) }}">{{ $s[ 'NAME' ] }}</a></li>
                    @endforeach
                @endif
                </ul>
            </div>
        </div>
        @include( 'layouts.general.message' )
        <div id="wrapper-body">
            @include( 'layouts.general.header' )
            <section>
            <div class="download position-fixed text-center">
                <p><i class="fas fa-download mr-2"></i>Descargar catálogo</p>
                <div class="d-flex">
                    @foreach( $data[ "descarga_publica" ] AS $d )
                    @php
                    $file = null;
                    if( !empty( $d->file ) )
                        $file = $d->file[ 0 ][ 'file' ][ 'i' ];
                    @endphp
                    <a href="{{ asset( $file ) }}" download class="d-inline-block px-2">{{ $d->name }}</a>
                    @endforeach
                </div>
            </div>
            @include( $data[ 'view' ] )
            </section>
            @include( 'layouts.general.footer' )
        </div>
        <!-- Scripts -->
        @include( 'layouts.general.script' )
        <!-- Código de instalación Cliengo para  www.hidratools.com -->
        <script type="text/javascript">(function () {
            var ldk = document.createElement('script');
            ldk.type = 'text/javascript';
            ldk.async = true;
            ldk.src = 'https://s.cliengo.com/weboptimizer/5cfee268e4b0e439bc1d44f6/5cfee269e4b0e439bc1d44f9.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ldk, s);
        })();</script>
        <script>
            window.url = "{{ url()->current() }}";
            window.url_base = "{{ URL::to( '/' ) }}";
            $( () => {
                $( ".carousel-caption .texto" ).css( {
                    marginTop: $("header").height()
                } );
                $( "#accordionMenu a").on( "click" , ( e ) => {
                    $(this).parent().stopPropagation();
                });
                $( ".dropdown-menu" ).click( ( e ) => {
                    e.stopPropagation();
                });
                $(window).resize(() => {
                    $( ".carousel-caption .texto" ).css( {
                        marginTop: $( "header" ).height()
                    } );
                });
            });
        </script>
        @stack( 'scripts' )
        <script src="{{ asset('js/bootstrap-autocomplete.js') }}"></script>
    </body>
</html>