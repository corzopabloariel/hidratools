<div class="card border-0 mt-2" id="wrapper-tabla">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table mb-0" id="tabla"></table>
        </div>
    </div>
    @isset( $paginate )
    <div class="card-footer d-flex justify-content-center">
        @if( isset( $buscar ) )
        {{ $paginate->appends( [ "buscar" => $buscar ] )->links() }}
        @else
        {{ $paginate->links() }}
        @endif
    </div>
    @endisset
</div>