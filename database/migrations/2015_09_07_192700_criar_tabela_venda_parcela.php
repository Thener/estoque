<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaVendaParcela extends Migration {

	private $table = 'venda_parcela';
	
    public function up() {

    	Schema::create($this->table, function (Blueprint $table) {
    		$table->increments('id');
    		$table->integer('venda_id');
    		$table->foreign('venda_id')->references('id')->on('venda');
    		$table->integer('numero_parcela');
    		$table->string('cheque_numero', 20)->nullable();
    		$table->float('valor_parcela', 12, 2);
    		$table->float('juros_multa', 12, 2)->nullable();
    		$table->date('data_vencimento');
    		$table->date('data_pagamento')->nullable();
    		$table->timestamps();
    	});    	
    }
        
    public function down() {
    	Schema::drop($this->table);
    }
}
