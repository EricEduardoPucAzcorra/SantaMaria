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
        Schema::create('detalle_reservaciones', function (Blueprint $table) {
            $table->increments('id_detalle_reserva');
            $table->date('fecha_registro');
            $table->float('total');
            //relaciones  con habitacion
            $table->integer('id_habitacion')->unsigned();
            $table->foreign('id_habitacion')->references('id_habitacion')->on('habitaciones');
            //relaciones  con reservaciones
            $table->integer('id_reserva')->unsigned();
            $table->foreign('id_reserva')->references('id_reserva')->on('reservaciones');
            //relacion con usuarios
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
        Schema::dropIfExists('detalle_reservaciones');
    }
};
