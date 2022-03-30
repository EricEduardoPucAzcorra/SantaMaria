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
        Schema::create('comandas', function (Blueprint $table) {
            $table->increments('id_comanda');
            // $table->string('folio_comanda',30);
            $table->date('fecha_comanda');
            $table->float('descuento');
            $table->enum('estado', ['ACEPTADO','CANCELADO']);
            $table->string('descripcion')->nullable();
            $table->integer('id_mesa')->unsigned();
            $table->foreign('id_mesa')->references('id_mesa')->on('mesas');
            $table->integer('id_usuario')->unsigned();
            $table->foreign('id_usuario')->references('id_usuario')->on('users');
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
        Schema::dropIfExists('comandas');
    }
};
