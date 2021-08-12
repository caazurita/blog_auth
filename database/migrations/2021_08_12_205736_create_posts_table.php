<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuarios_id');
            $table->foreign('usuarios_id','fk_posts_usuario')->references('id')->on('usuarios')->onDelete('cascade')->onUpdate('restrict');
            $table->string('titulo',100);
            $table->string('slug',100)->unique();
            $table->string('descripcion',200);
            $table->text('contenido');
            $table->boolean('estado')->default(1);
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
        Schema::dropIfExists('posts');
    }
}
