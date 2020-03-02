@php
$no_img = asset("images/no-img.png");
if( gettype( $i ) != "string" )
    $i = $i[ "i" ];
@endphp
@if( isset( $in_div ) )
    <div class="{{ $c }} d-flex" style="background-image: url( {{ asset( $i ) }} );">
    @isset( $text )
    <div class="container d-flex align-items-end">
        <div class="text">{{ $text }}</div>
    </div>
    @endisset
    </div>
@else
    <img src="{{ asset( $i ) . '?t=' . time() }}" alt="{{ $n }}" @isset( $f ) onclick="{{ $f }}" @endisset onerror="this.src='{{ $no_img }}'" @isset( $c ) class="{{ $c }}" @endisset/>
@endif