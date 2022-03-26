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
        Schema::create('reservaciones', function (Blueprint $table) {
            $table->increments('id_reserva');
            $table->date('fecha_entrada');
            $table->date('fecha_salida');
            $table->string('comentario')->nullable();
            ////relaciones  con habitacion "analizar"
            $table->integer('id_habitacion')->unsigned();
            $table->foreign('id_habitacion')->references('id_habitacion')->on('habitaciones');  
            $table->integer('cant_habitacion');

            $table->enum('estado', ['PENDIENTE', 'ACEPTADO', 'CANCELADO']);
            //relaciones con huesped
            $table->integer('id_huesped')->unsigned();
            $table->foreign('id_huesped')->references('id_huesped')->on('huespedes');
            //relacion usuario pendiente
            $table->float('precio');
            $table->float('total');

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
        Schema::dropIfExists('reservaciones');
    }
};
