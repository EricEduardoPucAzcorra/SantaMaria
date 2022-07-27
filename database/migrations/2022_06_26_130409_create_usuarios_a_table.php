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
        Schema::create('usuarios_a', function (Blueprint $table) {
            $table->increments('id_usuario');
            $table->String('nombre');
            $table->String('apellido_p');
            $table->String('apellido_m');
            $table->String('usuario');
            $table->String('password');
            $table->String('direccion');
            $table->String('telefono');
            $table->String('email');
            $table->String('id_rol');
            $table->String('imagen');
            $table->String('condicion');
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
        Schema::dropIfExists('usuarios_a');
    }
};
