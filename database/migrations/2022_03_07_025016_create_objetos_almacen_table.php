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
        Schema::create('objetos_almacen', function (Blueprint $table) {
            $table->increments('id_objeto');
            $table->string('nombre',50);
            $table->string('descripcion',100);
            $table->integer('cantidad');
            $table->integer('stock');
            $table->boolean('condicion')->default(1);
            //relacion con la tabla categorias_objeti
            $table->integer('id_categoria_obj')->unsigned();
            $table->foreign('id_categoria_obj')->references('id_categoria_obj')->on('categoria_objetos');

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
        Schema::dropIfExists('objetos_almacen');
    }
};
