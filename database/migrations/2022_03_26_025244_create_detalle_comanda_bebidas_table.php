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
        Schema::create('detalle_comanda_bebidas', function (Blueprint $table) {
            $table->increments('id_detalle_comandaB');
            $table->integer('id_bebida')->unsigned();
            $table->foreign('id_bebida')->references('id_bebida')->on('bebidas');
            $table->integer('id_comanda')->unsigned();
            $table->foreign('id_comanda')->references('id_comanda')->on('comandas');
            $table->integer('cantidad_bebida');
            $table->float('importe');
            $table->float('subtotal');
            $table->float('total');
            $table->string('nota');
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
        Schema::dropIfExists('detalle_comanda_bebidas');
    }
};
