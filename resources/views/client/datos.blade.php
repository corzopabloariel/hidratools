<div class="wrapper-contacto bg-white pb-5">
    @include( 'layouts.general.image' , [ 'i' => $data[ 'cabecera' ]->data[ 'header' ] , 'c' => 'cabecera' , 'in_div' => 1 ] )
    <div class="container py-5">
        <h2 class="text-center mb-5" style="font-weight: var( --contacto-name-font-weight ); color: var( --contacto-name-color ); font-family: var( --contacto-name-font-family );">Mis datos</h2>
        <div class="row justify-content-center">
            <div class="col-12 col-md-7">
                <form action="" method="post">
                    @csrf()
                    <h3 class="title mb-4">Personales</h3>
                    <input type="hidden" name="type" value="datos">
                    <div class="row">
                        <div class="col-12 col-md">
                            <input placeholder="Nombre" required type="text" name="name" class="form-control" value="{{ $data[ 'datos' ]->name }}">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12 col-md">
                            <input placeholder="Email" required type="email" name="email" class="form-control" value="{{ $data[ 'datos' ]->email }}">
                        </div>
                    </div>
    
                    <div class="row">
                        <div class="col-12 d-flex justify-content-end">
                            <button class="btn btn-warning px-4 rounded-pill">Cambiar</button>
                        </div>
                    </div>
                </form>
                <hr>
                <form action="" method="post">
                    @csrf()
                    <h3 class="title mb-4">Contraseña</h3>
                    <input type="hidden" name="type" value="pass">
                    
                    <div class="row">
                        <div class="col-12 col-md">
                            <input placeholder="Contraseña actual" required type="password" name="password" class="form-control">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12 col-md">
                            <input placeholder="Contraseña nueva" required type="password" name="password_new" class="form-control">
                        </div>
                    </div>
    
                    <div class="row">
                        <div class="col-12 d-flex justify-content-end">
                            <button class="btn btn-warning px-4 rounded-pill">Cambiar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>