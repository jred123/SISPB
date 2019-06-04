<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idcategoria')->unsigned();
            $table->integer('idsucursal')->unsigned();
            $table->integer('idmarca')->unsigned();
            $table->string('codigo', 50)->nullable();
            $table->integer('idpersona')->unsigned()->nullable();
            $table->string('nombre', 100);
            $table->decimal('precio_venta', 11, 2);
            $table->decimal('precio_compra', 11, 2)->nullable();
            $table->integer('stock');
            $table->string('descripcion', 256)->nullable();
            $table->boolean('condicion')->default(1);
            $table->timestamps();

            $table->foreign('idcategoria')->references('id')->on('categorias');
            $table->foreign('idsucursal')->references('id')->on('sucursals');
            $table->foreign('idmarca')->references('id')->on('marcas');
            $table->foreign('idpersona')->references('id')->on('personas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articulos');
    }
}
