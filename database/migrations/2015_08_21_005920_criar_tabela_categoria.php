<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaCategoria extends Migration {

    public function up() {

    	Schema::create('categoria', function (Blueprint $table) {
    		$table->increments('id');
    		$table->string('nome', 100);
    		$table->timestamps();
    	});    	
    }

    public function down() {
    	Schema::drop('categoria');
    }
}
