<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaFornecedor extends Migration {

	private $table = 'fornecedor';
	
    public function up() {

    	Schema::create($this->table, function (Blueprint $table) {
    		$table->increments('id');
    		$table->string('nome', 100);
    		$table->string('end_logradouro', 100)->nullable();
    		$table->string('end_numero', 20)->nullable();
    		$table->string('end_complemento', 20)->nullable();
    		$table->string('end_bairro', 50)->nullable();
    		$table->string('end_cidade', 50)->nullable();
    		$table->string('end_uf', 2)->nullable();
    		$table->string('end_cep', 10)->nullable();
    		$table->string('telefone_fixo', 20)->nullable(); 
    		$table->string('telefone_celular', 20)->nullable();
    		$table->string('email', 100)->nullable();
    		$table->timestamps();
    	});    	
    }

    public function down() {
    	Schema::drop($this->table);
    }
}
