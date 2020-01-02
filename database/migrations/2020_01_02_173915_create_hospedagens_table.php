<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospedagensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospedagens', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('quarto_id');
            $table->unsignedTinyInteger('tipo_id')->nullable();
            $table->unsignedTinyInteger('portador_id')->nullable();
            $table->unsignedInteger('grupo_id')->nullable();
            $table->date('data_entrada')->nullable();
            $table->date('data_saida')->nullable();
            $table->double('valtotal')->nullable();
            $table->string('nro_reserva', 10)->nullable();
            $table->text('obs')->nullable();
            $table->boolean('conferido')->default(0);
            $table->timestamps();

            $table->foreign('tipo_id')->references('id')->on('tipo_hospedagens');
            $table->foreign('portador_id')->references('id')->on('portadores');
            $table->foreign('quarto_id')->references('id')->on('quartos');
            $table->foreign('grupo_id')->references('id')->on('grupo_hospedagens');
        });

        Schema::create('hospedagem_cliente', function (Blueprint $table) {
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
        Schema::dropIfExists('hospedagens');
        Schema::dropIfExists('hospedagem_cliente');
    }
}
