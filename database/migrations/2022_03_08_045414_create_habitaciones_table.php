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
        Schema::create('habitaciones', function (Blueprint $table) {
            $table->increments('id_habitacion');
            $table->string('folio',10)->unique();
            $table->integer('num_habitacion')->unique();
            $table->float('precio');
            $table->string('caracteristicas',300);
            $table->integer('num_piso');
            $table->integer('num_personas');
            $table->enum('estado',['DISPONIBLE','OCUPADO','MANTENIMIENTO']);

            //relacion con el tipo de habitacion 
            $table->integer('id_tipo')->unsigned();
            $table->foreign('id_tipo')->references('id_tipo')->on('tipos_habitaciones');

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
        Schema::dropIfExists('habitaciones');
    }
};
