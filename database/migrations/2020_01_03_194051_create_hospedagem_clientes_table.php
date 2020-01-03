<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospedagemClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospedagem_clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hospedagem_id')->unsigned();
            $table->integer('cliente_id')->unsigned();
            $table->boolean('is_acompanhante');

            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('hospedagem_id')->references('id')->on('hospedagens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hospedagem_clientes');
    }
}
