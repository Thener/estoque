<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaVenda extends Migration {

	private $table = 'venda';
	
    public function up() {

    	Schema::create($this->table, function (Blueprint $table) {
    		$table->increments('id');
    		$table->integer('caixa_id');
    		$table->foreign('caixa_id')->references('id')->on('caixa');
    		$table->integer('cliente_id')->nullable();
    		$table->foreign('cliente_id')->references('id')->on('cliente');
    		$table->date('data_venda');
    		$table->string('tipo_venda', 3);
    		$table->float('valor_desconto', 12, 2)->nullable();
    		$table->float('percentual_desconto', 5, 2)->nullable();
    		$table->float('total_venda', 12, 2); // total sem desconto
    		$table->float('total_pagar', 12, 2); // total com desconto
    		$table->timestamps();
    	});    	
    }
    
    public function down() {
    	Schema::drop($this->table);
    }
}
