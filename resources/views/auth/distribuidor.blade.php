@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/menu.css') }}" rel="stylesheet">
@endpush

@section('headTitle', config('app.name') . ' :: Administración')

@section('content')
<div class="modal fade" id="modalCombinacion" tabindex="-1" role="dialog" aria-labelledby="modalCombinacionLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title">Combinaciones de teclas del sistema</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table mb-0">
                    <tbody>
                        <tr>
                            <td class="border-top-0">Alt+Ctrl+S</td>
                            <td class="border-top-0">Guardar elemento: guarda el contenido del elemento del formulario abierto</td>
                        </tr>
                        <tr>
                            <td>Alt+Ctrl+N</td>
                            <td>Abre o cierra el formulario: solo para secciones que tengan varios registros</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="wrapper flex-column">
    <header class="app-header navbar bg-white position-fixed shadow-sm w-100 px-0">
        <div class="d-flex align-items-center w-100">
            <nav class="navbar justify-content-between w-100 navbar-expand-lg navbar-light p-0">
                <div class="d-flex align-items-center ml-1">
                    <button id="btnMenu" class="btn btn-link mr-2" type="button" onclick="menu( this )">
                        <i class="fas fa-bars mt-n1"></i>
                    </button>
                    <a class="navbar-brand py-0" href="{{ route('adm') }}">ADMIN</a>
                </div>
                <button onclick="navMenu( this )" class="navbar-toggler mr-1" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse bg-white" id="navbarNavDropdown">
                    <ul class="navbar-nav px-3">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle pr-5" href="#" id="navbarDropdownMenuUsuario" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span><i class="fas fa-user-circle mr-2"></i>{{Auth::user()->name}}</span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuUsuario">
                                @if( !empty( Auth::user()->login) )
                                <a class="dropdown-item">
                                        @php
                                        $date = date( "d/m/Y H:i" , strtotime( Auth::user()->login ) ) ;
                                        @endphp
                                    <i class="fas fa-history mr-2 text-warning"></i><strong>{{$date}}</strong>
                                </a>
                                @endif
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('usuarios.datos') }}"><i class="fas fa-database mr-2"></i>Mis Datos</a>
                                <a class="dropdown-item" href="{{ route('adm.logout') }}"><i class="fas text-danger fa-power-off mr-2"></i>Salir</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('usuarios.index') }}"><i class="fas fa-user-friends mr-2"></i>Usuarios</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-uppercase pr-5" href="#" id="navbarDropdownMenuEmpresa" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ config('app.name') }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuEmpresa">
                                <a class="dropdown-item" href="{{ route('empresa.datos') }}"><i class="fab fa-centercode mr-2"></i>Datos de la Empresa</a>
                                <a class="dropdown-item" href="{{ route('imagen') }}"><i class="fas fa-image mr-2"></i>Imágenes sueltas</a>
                                <a class="dropdown-item" href="{{ route('empresa.form') }}"><i class="fab fa-wpforms mr-2"></i>Email de Formularios</a>
                                <a class="dropdown-item" href="{{ route('empresa.redes') }}"><i class='nav-icon fas fa-comment mr-2'></i>Redes Sociales</a>
                                <a class="dropdown-item" href="{{ route('metadatos.index') }}"><i class='nav-icon fas fa-bullhorn mr-2'></i>Metadatos</a>
                                <a class="dropdown-item" href="{{ route('empresa.terminos') }}"><i class='nav-icon fas fa-clipboard-check mr-2'></i>Términos y condiciones</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a onclick="showCombinacion( this );" class="nav-link" href="#"><i class="fas fa-keyboard mr-2"></i>Atajos</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('index') }}" class="nav-link" target="blank"><i class="fas mr-2 fa-external-link-alt"></i>Parte pública</a>
                        </li>
                        @isset( $data[ "err" ] )
                        <li class="nav-item">
                            <a data-toggle="tooltip" data-placement="bottom" title="Error de conexión con SQL Server" href="#" class="nav-link text-danger">ERROR DE CONEXIÓN<i class="fas fa-exclamation-triangle ml-1 text-warning"></i></a>
                        </li>
                        @endisset
                    </ul>
                </div>
            </nav>
    </header>
    
    <div class="app-body">
        <!-- Sidebar -->
        <nav id="sidebar">
            @include('layouts.menu')
        </nav>
        <!-- Page Content -->
        <div id="content">
            @if( !isset( $data[ "SIN" ] ) )
            <nav aria-label="breadcrumb" class="d-flex align-items-center bg-white" id="breadcrumb">
                <ol class="breadcrumb border-0 rounded-0 bg-white mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('adm') }}">ADMIN</a></li>
                    @if(!isset($data["breadcrumb"]))
                        <li class="breadcrumb-item active" aria-current="page">{{$data["title"]}}</li>
                    @else
                        {!! $data["breadcrumb"] !!}
                    @endif
                </ol>
            </nav>
            @endif
            @include($data['view'])
        </div>
    </div>
</div>
@endsection