<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaProduto extends Migration {

    public function up() {

    	Schema::create('produto', function (Blueprint $table) {
    		$table->increments('id');
    		$table->string('nome', 100);
    		$table->string('nome_abreviado', 50)->nullable();
    		$table->integer('categoria_id');
    		$table->foreign('categoria_id')->references('id')->on('categoria');
    		$table->float('preco_custo', 12, 2)->nullable();
    		$table->float('preco_venda', 12, 2)->nullable();
    		$table->string('codigo_barra', 100)->nullable();
    		$table->integer('estoque_atual')->nullable();
    		$table->timestamps();
    	});    	
    }

    public function down() {
    	Schema::drop('produto');
    }
}
