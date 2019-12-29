<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrupoHospedagensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo_hospedagens', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('tipo_id');
            $table->unsignedTinyInteger('portador_id');
            $table->string('nome', 50)->unique();
            $table->date('data_entrada')->nullable();
            $table->date('data_saida')->nullable();
            $table->text('obs')->nullable();
            $table->double('valor_quarto')->nullable();
            $table->timestamps();

            $table->foreign('tipo_id')->references('id')->on('tipo_hospedagens');
            $table->foreign('portador_id')->references('id')->on('portadores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupo_hospedagens');
    }
}
