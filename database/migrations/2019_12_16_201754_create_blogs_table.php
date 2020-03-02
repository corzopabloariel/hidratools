<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string('order',3)->nullable()->default(NULL);
            $table->string('title',150)->nullable()->default(NULL);
            $table->text('resume')->nullable()->default(NULL);
            $table->text('text')->nullable()->default(NULL);
            $table->unsignedBigInteger( 'category_id' )->nullable()->default( NULL );
            
            $table->foreign( 'category_id' )->references( 'id' )->on( 'blog_categorias' )->onDelete( 'cascade' );
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
        Schema::dropIfExists('blogs');
    }
}
