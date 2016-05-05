<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaCaixa extends Migration {

	private $table = 'caixa';
	
    public function up() {

    	Schema::create($this->table, function (Blueprint $table) {
    		$table->increments('id');
    		$table->date('data_caixa');
    		$table->date('data_fechamento')->nullable();
    		$table->string('aberto_por', 100);
    		$table->string('fechado_por', 100)->nullable();
    		$table->float('saldo_inicial', 12, 2)->nullable();
    		$table->float('total_entradas', 12, 2)->nullable();
    		$table->float('total_saidas', 12, 2)->nullable();
    		$table->float('saldo_final', 12, 2)->nullable();
    		$table->timestamps();
    	});    	
    }
    
    public function down() {
    	Schema::drop($this->table);
    }
}
