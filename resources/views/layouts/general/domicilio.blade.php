@php
$domicilio = "";
$domicilio = "{$dato[ 'calle' ]} {$dato[ 'altura' ]}";
if( !empty( $dato[ 'cp' ] ) )
    $domicilio .= " ({$dato[ 'cp' ]})";
if( !empty( $dato[ 'localidad' ] ) )
    $domicilio .= ", {$dato[ 'localidad' ]}";
if( !empty( $dato[ 'provincia' ] ) )
    $domicilio .= ", {$dato[ 'provincia' ]}";
if( !empty( $dato[ 'detalle' ] ) )
    $domicilio .= " - {$dato[ 'detalle' ]}";
@endphp
@if( $link )
    <a href="{{ $dato[ 'link' ] }}">{{ $domicilio }}</a>
@else
    {{ $domicilio }}
@endif