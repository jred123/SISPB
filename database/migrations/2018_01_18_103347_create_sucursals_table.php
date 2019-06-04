<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSucursalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sucursals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 50);
            $table->string('direccion', 256);
            $table->string('telefono',15);
            $table->boolean('condicion')->default(1);
            $table->timestamps();
        });
        DB::table('sucursals')->insert(array('id'=>'1','nombre'=>'Central', 'direccion'=>'Av Juan de la Rosa', 'telefono'=>'4444444'));
        DB::table('sucursals')->insert(array('id'=>'2','nombre'=>'Hipermaxy', 'direccion'=>'Av Juan de la Rosa', 'telefono'=>'4555555'));
        DB::table('sucursals')->insert(array('id'=>'3','nombre'=>'IC Norte', 'direccion'=>'Av America final Av Pando', 'telefono'=>'4666666'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sucursals');
    }
}
