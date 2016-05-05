<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaVendaProduto extends Migration {

	private $table = 'venda_produto';
	
    public function up() {

    	Schema::create($this->table, function (Blueprint $table) {
    		$table->increments('id');
    		$table->integer('venda_id');
    		$table->foreign('venda_id')->references('id')->on('venda');
    		$table->integer('produto_id');
    		$table->foreign('produto_id')->references('id')->on('produto');
    		$table->float('preco_custo', 12, 2);
    		$table->float('preco_venda', 12, 2);
    		$table->integer('quantidade');
    		$table->float('preco_item', 12, 2);
    		$table->timestamps();
    	});    	
    }
        
    public function down() {
    	Schema::drop($this->table);
    }
}
