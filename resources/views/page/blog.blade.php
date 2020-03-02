<div class="wrapper-blogs bg-white pb-5">
    @include( 'layouts.general.image' , [ 'i' => $data[ 'cabecera' ]->data[ 'header' ] , 'c' => 'cabecera' , 'in_div' => 1 , 'text' => $data[ 'blog' ]->title ] )
    <div class="container pt-3">
        <ol class="breadcrumb bg-transparent border-0 p-0">
            <li class="breadcrumb-item home"><a href="{{ URL::to( '/' ) }}"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ URL::to( 'blogs' ) }}">Blogs</a></li>
            <li class="breadcrumb-item"><a href="{{ URL::to( 'blogs/' . str_slug( $data[ 'blog' ]->category->title ) ) }}">{{ $data[ 'blog' ]->category->title }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $data[ 'blog' ]->title }}</li>
        </ol>
        <div class="row mt-5">
            <div class="col-12 col-md blog">
                @include( 'layouts.general.slider' , [ 'slider' => $data[ 'blog' ]->image , 'sliderID' => "slider" , 'div' => 0 , 'arrow' => 1 ] )
                @php
                $fecha = "";
                $aux = strtotime( $data[ 'blog' ]->date );
                $mes = [
                    "1" => "Enero",
                    "2" => "Febrero",
                    "3" => "Marzo",
                    "4" => "Abril",
                    "5" => "Mayo",
                    "6" => "Junio",
                    "7" => "Julio",
                    "8" => "Agosto",
                    "9" => "Septiembre",
                    "10" => "Octubre",
                    "11" => "Noviembre",
                    "12" => "Diciembre" ];
                $fecha = date( "d" , $aux ) . " " . $mes[ date( "n" , $aux ) ] . " del " . date( "Y" , $aux );
                @endphp
                <p class="date"><i class="far fa-clock mr-2"></i>{{ $fecha }}</p>
                <p class="title-category">{{ $data[ 'blog' ]->category->title }}</p>
                <h3 class="title-simple mt-3">{{ $data[ 'blog' ]->title }}</h3>
                <div class="mt-2">{!! $data[ 'blog' ]->text !!}</div>
                <div class="mt-4 border-top pt-3 d-flex justify-content-between more">
                    <div>
                        @if( !empty( $data[ "previous" ] ) )
                        <a href="{{ URL::to( 'blog/' . str_slug( $data[ 'previous' ]->title ) . '__' . date( 'Y-m-d' , strtotime( $data[ 'previous' ]->date ) ) . '/' . $data[ 'previous' ]->id ) }}" class="d-flex align-items-center"><i class="fas fa-angle-left mr-2"></i>{{ $data[ 'previous' ]->title }}</a>
                        @endif
                    </div>
                    <div>
                        @if( !empty( $data[ "next" ] ) )
                        <a href="{{ URL::to( 'blog/' . str_slug( $data[ 'next' ]->title ) . '__' . date( 'Y-m-d' , strtotime( $data[ 'next' ]->date ) ) . '/' . $data[ 'next' ]->id ) }}" class="d-flex align-items-center justify-content-end">{{ $data[ 'next' ]->title }}<i class="fas fa-angle-right ml-2"></i></a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                @include( 'page.parts.blog_lateral' )
            </div>
        </div>
    </div>
</div>