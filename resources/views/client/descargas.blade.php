<div class="wrapper-presupuesto wrapper-descargas pb-5 bg-white">
    @include( 'layouts.general.image' , [ 'i' => $data[ 'cabecera' ]->data[ 'header' ] , 'c' => 'cabecera' , 'in_div' => 1 , 'text' => 'DESCARGAS' ] )
    <div class="container pt-4 pb-5">
        <div class="row">
            <div class="col-12">
                <div class="list-group list-group-horizontal d-flex justify-content-center filtro" role="tablist">
                    <a class="list-group-item list-group-item-action bg-transparent active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">CATÁLOGOS</a>
                    <a class="list-group-item list-group-item-action bg-transparent" id="list-home-list2" data-toggle="list" href="#list-home2" role="tab" aria-controls="home2">LISTA DE PRECIOS</a>
                </div>
            </div>
            <div class="col-12 mt-5">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                        <div class="row mt-n4">
                            @foreach( $data[ "descargas" ][ "1" ] AS $d )
                            <div class="col-12 col-md-4 mt-4">
                                @include( 'layouts.general.image' , [ 'i' => $d->image , 'c' => 'w-100' , 'n' => empty( $d->name ) ? 'Descarga' : $d->name ] )
                                @php
                                $file = null;
                                if( !empty( $d->file ) )
                                    $file = asset( $d->file[ 0 ][ 'file' ][ 'i' ] );
                                @endphp
                                <div class="link p-3 d-flex justify-content-between align-items-center text-uppercase">
                                    {{ $d->name }}
                                    @if( !empty( $file ) )
                                    <a href="{{ $file }}" download class="btn btn-warning px-4 rounded-pill">descargar<i class="fas fa-arrow-alt-circle-down ml-2"></i></a>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-home2" role="tabpanel" aria-labelledby="list-profile-list">
                        <div class="row mt-n4">
                            @foreach( $data[ "descargas" ][ "2" ] AS $d )
                            <div class="col-12 col-md-4 mt-4">
                                @include( 'layouts.general.image' , [ 'i' => $d->image , 'c' => 'w-100' , 'n' => empty( $d->name ) ? 'Descarga' : $d->name ] )
                                <select onchange="downloadFile( this );" class="link form-control rounded-0 d-flex justify-content-between align-items-center text-uppercase">
                                    <option value="" hidden selected>{{ $d->name }}</option>
                                    @if( !empty( $d->file ) )
                                        @foreach( $d->file AS $f )
                                            <option value="{{ asset( $f[ 'file' ][ 'i' ] ) }}" data-txt="{{ $f[ 'name'] }}" data-name="{{ $f[ 'file' ][ 'n' ] }}" data-ext="{{ $f[ 'file' ][ 'e' ] }}">{{ $f[ 'name'] }} [{{ strtoupper( $f[ 'file' ][ 'e' ] ) }}]</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push( "scripts" )
<script>
    
    downloadFile = ( t ) => {
        if( $( t ).val() == "" )
            return false;
        let txt = $( t ).find( `option:selected` ).text();
        let name = $( t ).find( `option:selected` ).data( "name" );
        let ext = $( t ).find( `option:selected` ).data( "ext" );
        
        Toast.fire({
            icon: 'success',
            title: 'La descarga empezará en breve'
        });
        var link = document.createElement( "a" );
        href = $( t ).find( "option:selected" ).val();
        link.download = `${name}.${ext}`;
        link.href = href;
        document.body.appendChild( link );
        link.click();
        document.body.removeChild( link );
        $( t ).val( "" ).trigger( "change" );
    };
</script>
@endpush