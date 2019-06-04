<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 50);
            $table->string('descripcion', 256)->nullable();
            $table->boolean('condicion')->default(1);
            $table->timestamps();
        });
        DB::table('categorias')->insert(array('id'=>'1','nombre'=>'Celulares', 'descripcion'=>'Telefonos Moviles'));
        DB::table('categorias')->insert(array('id'=>'2','nombre'=>'Accesorios', 'descripcion'=>'Gadgets de Celulares'));
        DB::table('categorias')->insert(array('id'=>'3','nombre'=>'Laptops', 'descripcion'=>'Computadoras portatiles'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorias');
    }
}
