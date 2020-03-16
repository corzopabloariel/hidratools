<button class="btn btn-warning text-uppercase d-block d-sm-none rounded-0 mb-2" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    categorias<i class="fas fa-sort-amount-down ml-2"></i>
</button>
@php
$url_prev = "categoria";
if( isset( $pedido ) )
    $url_prev = "pedido/categoria";
@endphp
<div class="sidebar collapse bg-transparent dont-collapse-sm sticky-top" id="collapseExample">
    <div class="sidebar mt-n2">
        @foreach( $data[ "categorias"] AS $categoria)
        <div class="accordion md-accordion bg-transparent border-0 mt-2" id="accordionEx" role="tablist" aria-multiselectable="true">
            <div class="card bg-transparent border-0">
                @php
                $subcategorias = $categoria->categorias()->where( "elim" , 0 )->orderBy( "order" )->get();
                @endphp
                <div class="card-header bg-white p-0 border-bottom" role="tab" id="Hproductos{{ $categoria->id }}">
                    @php
                    $aria_expanded = "aria-expanded=false";
                    if( isset( $data[ 'categoria' ] ) ) {
                        if( $categoria->id == $data[ 'categoria' ]->id )
                            $aria_expanded = "aria-expanded=true";
                    }
                    $url_categoria = URL::to( 'productos/' . str_slug( $categoria->title ) );
                    @endphp
                    <h5 class="mb-0 parte d-flex justify-content-between align-items-center pb-2" data-parent="#accordionEx" data-toggle="collapse" data-target="#productos{{ $categoria->id }}" {{ $aria_expanded }} aria-controls="productos{{ $categoria->id }}">
                        <a href="{{ $url_categoria }}">
                            {{ $categoria->title }}
                        </a>
                        @if( $subcategorias->isNotEmpty() )
                        <i class="fas fa-angle-down rotate-icon ml-3"></i>
                        @endif
                    </h5>
                </div>
                @if( $subcategorias->isNotEmpty() )
                    @php
                    $class = "collapse pl-4 subcategorias";
                    if( isset( $data[ 'categoria' ] ) ) {
                        if( $categoria->id == $data[ 'categoria' ]->id )
                            $class .= " show";
                    }
                    @endphp
                    <div id="productos{{ $categoria->id }}" class="{{ $class }}" role="tabpanel" aria-labelledby="Hproductos{{ $categoria->id }}" data-parent="#accordionEx">
                        <div class="card-body bg-transparent p-0">

                        @foreach ( $subcategorias AS $subcategoria )
                            <div class="accordion md-accordion bg-transparent border-0 mt-2" id="accordionEx2" role="tablist" aria-multiselectable="true">
                                <div class="card bg-transparent border-0">
                                    @php
                                    $productos = $subcategoria->productos()->where( "elim" , 0 )->orderBy( "order" )->get();
                                    @endphp
                                    <div class="card-header bg-transparent p-0 border-0" role="tab" id="Hproductos{{ $categoria->id }}">
                                        @php
                                        $aria_expanded = "aria-expanded=false";
                                        if( isset( $data[ 'subcategoria' ] ) ) {
                                            if( $subcategoria->id == $data[ 'subcategoria' ]->id )
                                                $aria_expanded = "aria-expanded=true";
                                        }
                                        $url_categoria = URL::to( 'productos/' . str_slug( $categoria->title ) . '/' . str_slug( $subcategoria->title ) );
                                        @endphp
                                        <h5 class="mb-0 parte d-flex justify-content-between border-bottom-0 align-items-center pb-2" data-parent="#accordionEx2" data-toggle="collapse" data-target="#productos{{ $subcategoria->id }}" {{ $aria_expanded }} aria-controls="productos{{ $subcategoria->id }}">
                                            <a href="{{ $url_categoria }}">
                                                {{ $subcategoria->title }}
                                            </a>
                                        </h5>
                                    </div>
                                    @if( $productos->isNotEmpty() )
                                        @php
                                        $class = "collapse";
                                        if( isset( $data[ 'subcategoria' ] ) ) {
                                            if( $subcategoria->id == $data[ 'subcategoria' ]->id )
                                                $class .= " show";
                                        }
                                        @endphp
                                        @if( $productos->count() == 1 )
                                            @if( $productos[ 0 ]->title != $subcategoria->title )
                                                <div id="productos{{ $subcategoria->id }}" class="{{ $class }}" role="tabpanel" aria-labelledby="Hproductos{{ $subcategoria->id }}" data-parent="#accordionEx2">
                                                    <div class="card-body bg-transparent p-0">
                                                        <ul class="list-group list-group-flush productos">
                                                            @foreach ( $productos AS $producto )
                                                            @php
                                                            $class = "d-block";
                                                            if( isset( $data[ "producto" ] ) ) {
                                                                if( $producto->id == $data[ "producto" ]->id )
                                                                    $class .= " active";
                                                            }
                                                            $url_producto = URL::to( 'producto/' . str_slug( $producto->title ) );
                                                            @endphp
                                                            <li class="list-group-item bg-transparent border-0 py-2">
                                                                <a class="{{ $class }}" href="{{ $url_producto }}">{{ $producto->title }}</a>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endif
                                        @else
                                            <div id="productos{{ $subcategoria->id }}" class="{{ $class }}" role="tabpanel" aria-labelledby="Hproductos{{ $subcategoria->id }}" data-parent="#accordionEx2">
                                                <div class="card-body bg-transparent p-0">
                                                    <ul class="list-group list-group-flush productos">
                                                        @foreach ( $productos AS $producto )
                                                        @php
                                                        $class = "d-block";
                                                        if( isset( $data[ "producto" ] ) ) {
                                                            if( $producto->id == $data[ "producto" ]->id )
                                                                $class .= " active";
                                                        }
                                                        $url_producto = URL::to( 'producto/' . str_slug( $producto->title ) );
                                                        @endphp
                                                        <li class="list-group-item bg-transparent border-0 py-2">
                                                            <a class="{{ $class }}" href="{{ $url_producto }}">{{ $producto->title }}</a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>