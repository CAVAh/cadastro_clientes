<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 80);
            $table->string('rg', 13)->nullable();
            $table->string('cpf', 11)->nullable();
            $table->integer('profissao_id')->nullable();
            $table->date('data_nasc')->nullable();
            $table->enum('sexo', ['F', 'M']);
            $table->string('endereco', 100)->nullable();
            $table->integer('cidade_id')->nullable();
            $table->integer('bairro_id')->nullable();
            $table->integer('cep')->nullable();
            $table->string('fone', 14)->nullable();
            $table->string('celular', 15)->nullable();
            $table->string('celular2', 15)->nullable();
            $table->string('email', 100)->nullable();
            $table->text('obs')->nullable();
            $table->boolean('cpf_conferido')->default(0);
            $table->boolean('verificado')->default(0);
            $table->boolean('hospedou')->default(1);
            $table->timestamps();

            $table->foreign('profissao_id')->references('id')->on('profissoes');
            $table->foreign('cidade_id')->references('id')->on('cidades');
            $table->foreign('bairro_id')->references('id')->on('bairros');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
