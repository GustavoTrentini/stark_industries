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
            $table->id();
            $table->string('nome', 150);
            $table->string('foto')->nullable();
            $table->string('cpf', 20)->unique();
            $table->string('rg', 12)->unique();
            $table->date('data_nasc');
            $table->string('cep');
            $table->string('logradouro', 100);
            $table->string('numero', 20);
            $table->string('bairro', 50);
            $table->string('cidade', 60);
            $table->string('uf', 2);
            $table->string('complemento', 150)->nullable();
            $table->timestamps();
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
