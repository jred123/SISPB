<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->foreign('id')->references('id')->on('personas')->onDelete('cascade');
            
            $table->string('usuario')->unique();
            $table->string('password');
            $table->string('sucursal');
            $table->boolean('condicion')->default(1);

            $table->integer('idrol')->unsigned();
            $table->foreign('idrol')->references('id')->on('roles');


            $table->rememberToken();
            //$table->timestamps();
        });
        DB::table('users')->insert(array('id'=>'1','usuario'=>'admin', 'password'=>bcrypt('admin'), 'sucursal'=>'Central', 'idrol'=>'1'));
        DB::table('users')->insert(array('id'=>'2','usuario'=>'paola.l', 'password'=>bcrypt('paola'), 'sucursal'=>'Ic Norte', 'idrol'=>'4'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
