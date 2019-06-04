<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrigger3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER tr_Ventas AFTER INSERT ON `detalle_ventas` 
        FOR EACH ROW BEGIN
        if (new.estado=0) then
         UPDATE articulos SET stock = stock - NEW.cantidad
         WHERE articulos.id = NEW.idarticulo;
         end if;
        END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `tr_Ventas`');
    }
}
