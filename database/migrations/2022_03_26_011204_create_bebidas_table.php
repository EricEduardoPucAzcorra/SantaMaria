<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bebidas', function (Blueprint $table) {
            $table->increments('id_bebida');
            $table->string('folio',7)->unique();
            $table->string('nombre')->unique();
            $table->string('descripcion');
            $table->integer('id_categoriaB')->unsigned();
            $table->foreign('id_categoriaB')->references('id_categoriaB')->on('categoria_bebidas');
            $table->float('precio');
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
        Schema::dropIfExists('bebidas');
    }
};
