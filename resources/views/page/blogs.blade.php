<div class="wrapper-blogs bg-white pb-5">
    @include( 'layouts.general.image' , [ 'i' => $data[ 'cabecera' ]->data[ 'header' ] , 'c' => 'cabecera' , 'in_div' => 1 , 'text' => 'BLOGS' ] )
    <div class="container">
        <div class="row pt-4 pb-5">
            <div class="col-12 col-md">
                <div class="wrapper-videos">
                    <h3 class="title text-center mb-3">Destacadas</h3>
                    <div class="row wrapper-blog mt-n5">
                        @foreach( $data[ "blogs_destacado" ] AS $b )
                        <div class="hover col-12 col-md-6 mt-5">
                            @include( 'page.parts.blog' , [ 'elemento' => $b , 'type' => 1 ] )
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md">
                <div class="wrapper-videos">
                    <h3 class="title text-center mb-3">Noticias</h3>
                    <div class="row wrapper-blog mt-n5">
                        @foreach( $data[ "blogs" ] AS $b )
                        <div class="hover col-12 col-md-6 mt-5">
                            @include( 'page.parts.blog' , [ 'elemento' => $b , 'type' => 0 ] )
                        </div>
                        @endforeach
                    </div>
                    <div class="row mt-5">
                        <div class="col-12 d-flex justify-content-center">{{ $data[ "blogs" ]->links() }}</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                @include( 'page.parts.blog_lateral' )
            </div>
        </div>
    </div>
</div>