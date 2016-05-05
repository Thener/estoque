<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaMovimentoCaixa extends Migration {

	private $table = 'movimento_caixa';
	
    public function up() {

    	Schema::create($this->table, function (Blueprint $table) {
    		$table->increments('id');
    		$table->integer('caixa_id');
    		$table->foreign('caixa_id')->references('id')->on('caixa');
    		$table->integer('user_id');
    		$table->foreign('user_id')->references('id')->on('users');
    		$table->integer('venda_id')->nullable();
    		$table->foreign('venda_id')->references('id')->on('venda');
    		$table->string('descricao', 100)->nullable();
    		$table->string('tipo_movimento', 1); // E: Entrada - S: Sa�da
    		$table->float('valor_movimento', 12, 2);
    		$table->timestamps();
    	});    	
    }
    
    public function down() {
    	Schema::drop($this->table);
    }
}
