<p>
@if( $dato[ "is_link" ] )
    @if( !empty( $dato[ "telefono" ] ) && !empty( $dato[ "visible" ] ) )
        @if( $dato[ "tipo" ] == "tel" )
        <a class="text-truncate d-inline-block" title="{{ $dato[ 'visible' ] }}" href="tel:{{ $dato[ 'telefono' ] }}">{{ $dato[ "visible" ] }}</a>
        @else
        <a class="whatsapp text-truncate d-inline-block" title="WHATSAPP: {{ $dato[ 'visible' ] }}" href="https://wa.me/{{ $dato[ 'telefono' ] }}">{{ $dato[ "visible" ] }}</a>
        @endif
    @endif
@else
    @if( empty( $dato[ "telefono" ] ) && !empty( $dato[ "visible" ] ) )
    <span title="{{ $dato[ 'visible' ] }}">{{ $dato[ "visible" ] }}</span>
    @elseif( empty( $dato[ "visible" ] ) && !empty( $dato[ "telefono" ] ) )
    <span title="{{ $dato[ 'telefono' ] }}">{{ $dato[ "telefono" ] }}</span>
    @else
    <span title="{{ $dato[ 'visible' ] }}">{{ $dato[ "visible" ] }}</span>
    @endif
@endif
</p>
@if( !empty( $dato[ "texto" ] ) )
<p class="text-center mt-n2">{{ $dato[ "texto" ] }}</p>
@endif