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
        Schema::create('tipos_habitaciones', function (Blueprint $table) {
            $table->increments('id_tipo');
            $table->string('tipo');
            $table->string('descripcion');
            $table->timestamps();
        });

         //registros de roles estaticos
        DB::table('tipos_habitaciones')->insert(array('id_tipo'=>'1', 'tipo'=>'Simple', 'descripcion'=>'Null'));
        DB::table('tipos_habitaciones')->insert(array('id_tipo'=>'2', 'tipo'=>'Estandar', 'descripcion'=>'Null'));
        DB::table('tipos_habitaciones')->insert(array('id_tipo'=>'3', 'tipo'=>'Con vista', 'descripcion'=>'Null'));
        DB::table('tipos_habitaciones')->insert(array('id_tipo'=>'4', 'tipo'=>'Familiar', 'descripcion'=>'Null'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipos_habitaciones');
    }
};
