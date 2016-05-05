<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Venda extends Model {
    
	protected $table = 'venda';
	
	protected $fillable = array(
		'caixa_id',
		'cliente_id',
		'data_venda',
		'tipo_venda', 
		'valor_desconto',
		'percentual_desconto',
		'total_venda'
	);
	
	public function cliente() {
		return $this->belongsTo('App\Models\Cliente');
	}
		
	public function produtos() {
		return $this->hasMany('App\Models\VendaProduto');
	}

	public function parcelas() {
		return $this->hasMany('App\Models\VendaParcela');
	}	

	public static function getTiposVenda($empty = false, $emptyMsg = 'Selecione...') {
		
		if ($empty) {
			$itens[] = $emptyMsg;
		}
		
		$itens['DIN'] = 'Dinheiro';
		$itens['CAR'] = 'Cartão';
		$itens['CRE'] = 'Crediário';
		
		return $itens;
	}
	
	public function getNomeTipoVenda() {
		$itens = self::getTiposVenda();
		return $itens[$this->tipo_venda];
	}

	public function setDataVendaAttribute($value) {
		$this->attributes['data_venda'] = DateUtil::dateToStorage($value);
	}
	
	public function getDataVendaAttribute($value) {
		return DateUtil::dateToView($value);
	}

	public function setValorDescontoAttribute($value) {
		$this->attributes['valor_desconto'] = MoneyUtil::moneyToStorage($value);
	}
	
	public function getValorDescontoAttribute($value) {
		return MoneyUtil::moneyToView($value);
	}

	public function setPercentualDescontoAttribute($value) {
		$this->attributes['percentual_desconto'] = MoneyUtil::moneyToStorage($value);
	}
	
	public function getPercentualDescontoAttribute($value) {
		return MoneyUtil::moneyToView($value);
	}

	public function setTotalVendaAttribute($value) {
		$this->attributes['total_venda'] = MoneyUtil::moneyToStorage($value);
	}
	
	public function getTotalVendaAttribute($value) {
		return MoneyUtil::moneyToView($value);
	}	
}
