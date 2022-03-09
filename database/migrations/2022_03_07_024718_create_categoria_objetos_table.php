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
        Schema::create('categoria_objetos', function (Blueprint $table) {
            $table->increments('id_categoria_obj');
            $table->string('nombre', 50);
            $table->string('descripcion', 100);
            $table->boolean('condicion')->default(1);          
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
        Schema::dropIfExists('categoria_objetos');
    }
};
