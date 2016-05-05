<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VendaProduto extends Model {
    
	protected $table = 'venda_produto';
	
	protected $fillable = array(
			'venda_id',
			'produto_id',
			'preco_custo',
			'preco_venda',
			'quantidade',
			'preco_item'
	);

	public function venda() {
		return $this->belongsTo('App\Models\Venda');
	}
	
	public function produto() {
		return $this->belongsTo('App\Models\Produto');
	}	
		
	public function setPrecoCustoAttribute($value) {
		$this->attributes['preco_custo'] = MoneyUtil::moneyToStorage($value);
	}
	
	public function getPrecoCustoAttribute($value) {
		return MoneyUtil::moneyToView($value);
	}

	public function setPrecoVendaAttribute($value) {
		$this->attributes['preco_venda'] = MoneyUtil::moneyToStorage($value);
	}
	
	public function getPrecoVendaAttribute($value) {
		return MoneyUtil::moneyToView($value);
	}	
	
	public function setPrecoItemAttribute($value) {
		$this->attributes['preco_item'] = MoneyUtil::moneyToStorage($value);
	}
	
	public function getPrecoItemAttribute($value) {
		return MoneyUtil::moneyToView($value);
	}	
}
