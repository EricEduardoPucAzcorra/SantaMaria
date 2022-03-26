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
        Schema::create('platillos', function (Blueprint $table) {
            $table->increments('id_plato');
            $table->string('folio',7)->unique();
            $table->string('nombre')->unique();
            $table->string('descripcion');
            $table->integer('id_categoriaP')->unsigned();
            $table->foreign('id_categoriaP')->references('id_categoriaP')->on('categoria_platillos');
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
        Schema::dropIfExists('platillos');
    }
};
