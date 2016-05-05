<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VendaParcela extends Model {
    
	protected $table = 'venda_parcela';
	
	protected $fillable = array(
			'venda_id',
			'numero_parcela',
			'cheque_numero',
			'valor_parcela',
			'juros_multa',
			'data_vencimento',
			'data_pagamento'
	);
	
	public function venda() {
		return $this->belongsTo('App\Models\Venda');
	}
		
	public function setValorParcelaAttribute($value) {
		$this->attributes['valor_parcela'] = MoneyUtil::moneyToStorage($value);
	}
	
	public function getValorParcelaAttribute($value) {
		return MoneyUtil::moneyToView($value);
	}

	public function setJurosMultaAttribute($value) {
		$this->attributes['juros_multa'] = MoneyUtil::moneyToStorage($value);
	}
	
	public function getJurosMultaAttribute($value) {
		return MoneyUtil::moneyToView($value);
	}	
	
	public function setDataVencimentoAttribute($value) {
		$this->attributes['data_vencimento'] = DateUtil::dateToStorage($value);
	}
	
	public function getDataVencimentoAttribute($value) {
		return DateUtil::dateToView($value);
	}

	public function setDataPagamentoAttribute($value) {
		$this->attributes['data_pagamento'] = DateUtil::dateToStorage($value);
	}
	
	public function getDataPagamentoAttribute($value) {
		return DateUtil::dateToView($value);
	}
	
}
