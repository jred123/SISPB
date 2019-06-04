<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrigger2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE TRIGGER tr_upStockTransAnular AFTER UPDATE ON transferencias FOR EACH ROW 
        BEGIN 
        if (new.estado=\'Eliminada\') then
        UPDATE articulos a
        JOIN detalle_transferencias dt
        ON dt.idarticulo = a.id
        AND dt.idtransferencia = new.id
        
        SET a.stock = a.stock + dt.cantidad;
        end if;
        END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `tr_upStockTransAnular`');
    }
}
