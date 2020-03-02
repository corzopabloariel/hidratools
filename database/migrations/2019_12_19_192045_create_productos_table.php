<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json('images')->nullable()->default(NULL);
            $table->string('order',5)->nullable()->default(NULL);
            $table->string('title',150)->nullable()->default(NULL);
            $table->string('subtitle',100)->nullable()->default(NULL);
            $table->text('descripcion')->nullable()->default(NULL);
            $table->json('manual',200)->nullable()->default(NULL);
            $table->json('ficha',200)->nullable()->default(NULL);
            $table->text('utilidad')->nullable()->default(NULL);
            $table->json('caracteristicas')->nullable()->default(NULL);
            $table->text('text')->nullable()->default(NULL);
            $table->json('planos')->nullable()->default(NULL);
            $table->json('accesorios')->nullable()->default(NULL);
            $table->string('youtube',20)->nullable()->default(NULL);
            $table->unsignedBigInteger( 'categoria_id' )->nullable()->default( NULL );
            
            $table->foreign( 'categoria_id' )->references( 'id' )->on( 'categorias' )->onDelete( 'cascade' );
            $table->boolean('elim')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
