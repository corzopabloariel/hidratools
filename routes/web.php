<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get( '{link?}' ,
    [ 'uses' => 'Page\GeneralController@index' , 'as' => 'index' ]
)->where( 'link' , "index|empresa|contacto|catalogo|productos|novedades|calidad|videos|blogs|servicios|presupuesto" );
Route::get('consulta/{title}/{id}', ['uses' => 'Page\GeneralController@consulta' , 'as' => 'consulta']);
Route::get('consulta/servicio/{title}/{id}', ['uses' => 'Page\GeneralController@consulta2' , 'as' => 'consulta2']);
Route::get('consulta/{title}/{id}/{index?}/{name?}', ['uses' => 'Page\GeneralController@consulta' , 'as' => 'consulta']);
Route::get('servicio/{title}/{id}', ['uses' => 'Page\GeneralController@servicio' , 'as' => 'servicio']);
Route::get('servicio/{title}/{id}/consulta', ['uses' => 'Page\GeneralController@consulta2' , 'as' => 'consulta2']);
Route::get('blog/{title}/{id}', ['uses' => 'Page\GeneralController@blog' , 'as' => 'blog']);
Route::get('blogs/{slug_category}/{id}', ['uses' => 'Page\GeneralController@blog_category' , 'as' => 'blog_category']);
Route::get('productos/{title}/', ['uses' => 'Page\GeneralController@categoria' , 'as' => 'categoria']);
Route::get('productos/{ntitle}/{title}', ['uses' => 'Page\GeneralController@subcategoria' , 'as' => 'subcategoria']);
Route::get('producto/{title}', ['uses' => 'Page\GeneralController@producto' , 'as' => 'producto']);
Route::get('buscar', ['uses' => 'Page\GeneralController@buscar' , 'as' => 'buscar']);

Route::post('consulta/{title}/{id}/{index?}/{name?}', ['uses' => 'Page\FormController@contacto' , 'as' => 'consulta']);
Route::post('contacto', ['uses' => 'Page\FormController@contacto', 'as' => 'contacto']);
Route::post('presupuesto', ['uses' => 'Page\FormController@presupuesto', 'as' => 'presupuesto']);
Route::post('producto/{title}', ['uses' => 'Page\FormController@presupuesto' , 'as' => 'producto']);
Auth::routes();

Route::get('salir', 'PrivateArea\LoginController@salir')->name('salir');
Route::group(['prefix' => 'cliente', 'as' => 'client.'], function() {
    Route::get('changeClave/{id}', 'PrivateArea\UsuarioController@changeClave')->name('changeClave');
    Route::post('changepass','PrivateArea\UsuarioController@changepass')->name("changepass");
    Route::post('acceso', 'PrivateArea\LoginController@login')->name("acceso");
});

Route::group(['middleware' => 'client' ], function() {
    Route::get('cliente/descargas', ['uses' => 'PrivateArea\GeneralController@descargas' , 'as' => 'descargas']);
    Route::match(['get', 'post'], 'cliente/datos', [ 'uses' => 'PrivateArea\GeneralController@mis_datos', 'as' => 'mis_datos' ]);
});

Route::get('salir', 'PrivateArea\LoginController@salir')->name('salir');

Route::group(['middleware' => 'auth', 'prefix' => 'adm'], function() {
    Route::get('/', 'Auth\AdmController@index')->name('adm');
    Route::get('logout', ['uses' => 'Auth\LoginController@logout' , 'as' => 'adm.logout']);
    Route::get('empresa/imagen', ['uses' => 'Auth\AdmController@imagen', 'as' => 'imagen']);
    Route::delete('imagen/delete', ['uses' => 'Auth\AdmController@imagenDestroy', 'as' => 'imagen.delete']);
    Route::post('imagen', ['uses' => 'Auth\AdmController@imagenStore', 'as' => 'imagen.create']);

    Route::get('cabeceras', ['uses' => 'Auth\CabecerasController@index', 'as' => 'cabeceras.index']);
    Route::get('cabeceras/update/{table}', ['uses' => 'Auth\CabecerasController@update', 'as' => 'cabeceras.update']);
    /**
     * SLIDERS
     */
    Route::resource('slider', 'Auth\SliderController')->except(['index','update','show']);
    Route::get('slider/{seccion}', ['uses' => 'Auth\SliderController@index', 'as' => 'slider.index']);
    Route::post('slider/update/{id}', ['uses' => 'Auth\SliderController@update', 'as' => 'slider.update']);
    /**
     * CONTENIDO
     */
    Route::group(['prefix' => 'contenido', 'as' => 'contenido'], function() {
        Route::get('{seccion}/edit', ['uses' => 'Auth\ContenidoController@edit', 'as' => '.edit']);
        Route::post('{seccion}/update', ['uses' => 'Auth\ContenidoController@update', 'as' => 'update']);
    });
    /**
     * POPUP
     */
    Route::resource('popups', 'Auth\PopupController')->except(['update']);
    Route::post('popups/update/{id}', ['uses' => 'Auth\PopupController@update', 'as' => 'popups.update']);
    /**
     * SERVICIOS
     */
    Route::resource('servicios', 'Auth\ServicioController')->except(['update']);
    Route::post('servicios/update/{id}', ['uses' => 'Auth\ServicioController@update', 'as' => 'servicios.update']);
    /**
     * DESCARGAS
     */
    Route::resource('descargas', 'Auth\DescargaController')->except(['update']);
    Route::post('descargas/update/{id}', ['uses' => 'Auth\DescargaController@update', 'as' => 'descargas.update']);
    /**
     * VIDEOS
     */
    Route::resource('videos', 'Auth\VideoController')->except(['update']);
    Route::post('videos/update/{id}', ['uses' => 'Auth\VideoController@update', 'as' => 'videos.update']);
    /**
     * CLIENTES
     */
    Route::resource('clientes', 'Auth\ClienteController')->except(['update']);
    Route::post('clientes/update/{id}', ['uses' => 'Auth\ClienteController@update', 'as' => 'clientes.update']);
    /**
     * BLOG
     */
    Route::resource('blogs', 'Auth\BlogController')->except(['update']);
    Route::post('blogs/update/{id}', ['uses' => 'Auth\BlogController@update', 'as' => 'blogs.update']);

    Route::resource('blogcategorias', 'Auth\BlogCategoriaController')->except(['update','index']);
    Route::get('blog/categorias', ['uses' => 'Auth\BlogCategoriaController@index', 'as' => '.blogcategorias.index']);
    Route::post('blogcategorias/update/{id}', ['uses' => 'Auth\BlogCategoriaController@update', 'as' => 'blogcategorias.update']);
    /**
     * CATEGORIAS
     */
    Route::resource('categorias', 'Auth\CategoriaController')->except(['update']);
    Route::post('categorias/update/{id}', ['uses' => 'Auth\CategoriaController@update', 'as' => 'categorias.update']);

    Route::get('categoria/{id}/subcategorias', ['uses' => 'Auth\SubCategoriaController@index', 'as' => 'subcategorias.index']);
    Route::resource('subcategorias', 'Auth\CategoriaController')->except(['update','index']);
    Route::post('subcategorias/update/{id}', ['uses' => 'Auth\CategoriaController@update', 'as' => 'subcategorias.update']);
    /**
     * PRODUCTOS
     */
    Route::resource('productos', 'Auth\ProductoController')->except(['update']);
    Route::post('productos/update/{id}', ['uses' => 'Auth\ProductoController@update', 'as' => 'productos.update']);
    
    /**********************************
            DATOS DE LA EMPRESA        
     ********************************** */
    Route::resource('usuarios', 'Auth\UserController')->except(['update']);
    Route::post('usuarios/update/{id}', ['uses' => 'Auth\UserController@update', 'as' => 'usuarios.update']);
    Route::get('usuario/datos', ['uses' => 'Auth\UserController@datos', 'as' => 'usuarios.datos']);

    Route::get('empresa/metadatos', ['uses' => 'Auth\MetadatosController@index', 'as' => 'metadatos.index']);
    Route::post('metadatos/update/{page}', ['uses' => 'Auth\MetadatosController@update', 'as' => 'metadatos.update']);

    //Route::resource('redes', 'Auth\EmpresaController')->except(['index','update']);
    Route::get('empresa/redes', ['uses' => 'Auth\EmpresaController@redes', 'as' => 'empresa.redes']);
    Route::post('redes', ['uses' => 'Auth\EmpresaController@redesStore', 'as' => 'redes.create']);
    Route::get('redes/{id}/edit', ['uses' => 'Auth\EmpresaController@redesEdit', 'as' => 'empresa.edit']);
    Route::post('redes/update/{id}', ['uses' => 'Auth\EmpresaController@redesUpdate', 'as' => 'redes.update']);
    Route::delete('redes/delete', ['uses' => 'Auth\EmpresaController@redesDestroy', 'as' => 'redes.delete']);

    Route::group(['prefix' => 'empresa', 'as' => 'empresa'], function() {
        Route::get('datos', ['uses' => 'Auth\EmpresaController@datos', 'as' => '.datos']);
        Route::match(['get', 'post'], 'terminos',['as' => '.terminos','uses' => 'Auth\EmpresaController@terminos' ]);
        Route::match(['get', 'post'], 'form',['as' => '.form','uses' => 'Auth\EmpresaController@form' ]);
        Route::post('update', ['uses' => 'Auth\EmpresaController@update', 'as' => '.update']);
    });
});
