<div class="mt-2" id="wrapper-tabla">
    <div class="card-columns"></div>
    @isset( $paginate )
    <div class="mt-5 d-flex flex-wrap justify-content-center">
        {{ $paginate->links() }}
    </div>
    @endisset
</div>