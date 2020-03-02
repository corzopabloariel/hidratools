<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->json( 'email' )->nullable()->default( NULL );
            $table->json( 'phone' )->nullable()->default( NULL );
            $table->json( 'domicile' )->nullable()->default( NULL );
            $table->json( 'social_networks' )->nullable()->default( NULL );
            $table->json( 'images' )->nullable()->default( NULL );
            $table->json( 'metadata' )->nullable()->default( NULL );
            $table->json( 'form' )->nullable()->default( NULL );
            $table->json( 'sections' )->nullable()->default( NULL );
            
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
        Schema::dropIfExists('empresa');
    }
}
