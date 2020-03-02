<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('headTitle')</title>
    <link href="{{ asset('favicon.png') }}" rel="icon" type="image/png">
    <link href="{{ asset('css/adm/login.css') }}" rel="stylesheet">
    @include('layouts.general.css')
    @stack('styles')
</head>
<body>
    
    @include('layouts.general.message')
    @yield('content')
    @include('layouts.general.script')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        window.url = "{{ url()->current() }}";
        window.usr_data = @json( Auth::user() );
        const src = "{{ asset('images/no-img.png') }}";
        const url_simple = `{{ URL::to('/') }}`;
        @isset( $data )
        window.data = @json($data);
        if( window.data.url !== undefined )
            window.url = window.data.url;
        @endisset
        $( () => {
            $( '[data-toggle="tooltip"]' ).tooltip();
            if( localStorage.sidebar !== undefined )
                $( "#btnMenu" ).click();

            if( $( "#sidebar" ).find( `a[href="${window.url}"]` ).data( "link" ) == "u" ) {
                $( "#sidebar" ).find( `a[href="${window.url}"]` ).addClass( "active" );
                $( "#sidebar" ).find( `a[href="${window.url}"]` ).closest( "ul" ).addClass( "show" );
                $( "#sidebar" ).find( `a[href="${window.url}"]` ).closest( "ul" ).prev().attr( "aria-expanded" , true ).parent().addClass( "active" );
            } else
                $( "#sidebar" ).find( `a[href="${window.url}"]` ).parent().addClass( "active" );
        } );
    </script>
    @stack('scripts')
</body>
</html>