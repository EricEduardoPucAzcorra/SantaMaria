<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id_rol');
            $table->string('nombre',50)->unique();
            $table->string('descripcion',100)->nullable();
            $table->boolean('condicion')->default(1);
            
        });
        //registros de roles estaticos
        DB::table('roles')->insert(array('id_rol'=>'1', 'nombre'=>'Administrador', 'descripcion'=>'Gestionador'));
        DB::table('roles')->insert(array('id_rol'=>'2', 'nombre'=>'Recepcionista', 'descripcion'=>'Recepciona en hoespedaje'));
        DB::table('roles')->insert(array('id_rol'=>'3', 'nombre'=>'Mesero', 'descripcion'=>'Mesero de alimentos'));
        DB::table('roles')->insert(array('id_rol'=>'4', 'nombre'=>'Cocina', 'descripcion'=>'Recepcion de cocina'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
};
