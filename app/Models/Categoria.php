<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model {
    
	protected $table = 'categoria';
	
	protected $fillable = array(
			'nome'
	);	
	
	public function produtos() {
		return $this->hasMany('App\Models\Produto');
	}
}
