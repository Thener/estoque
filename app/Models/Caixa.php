<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Caixa extends Model {
    
	protected $table = 'caixa';
	
	protected $fillable = [
			'data_caixa',
			'data_fechamento',
			'aberto_por',
			'fechado_por',
			'saldo_inicial',
			'total_entradas',
			'total_saidas',
			'saldo_final'
	];
	
	public static function paginate($request) {
	
		$page 		= $request->input('page');
		$rp 		= $request->input('rp');
		$sortname 	= $request->input('sortname');
		$pesquisa 	= $request->input('query');
		$sortorder 	= $request->input('sortorder');
		$qtype 		= $request->input('qtype');
		$filtros 	= $request->input('filtros');
	
		$offset = ($page == 1) ? 0 : ($page-1) * $rp;
		
		if ($pesquisa == '') {
			$operador = '>=';
			$pesquisa = 0;
		} else {
			$operador = '=';
		}
	
		return Caixa::orderBy($sortname, $sortorder)
			->offset($offset)
			->limit($rp)
			->where($qtype, $operador, $pesquisa)
			->get();
	}
	
	public function setDataCaixaAttribute($value) {
		$this->attributes['data_caixa'] = DateUtil::dateToStorage($value);
	}
	
	public function getDataCaixaAttribute($value) {
		return DateUtil::dateToView($value);
	}
	
	public function setDataFechamentoAttribute($value) {
		$this->attributes['data_fechamento'] = DateUtil::dateToStorage($value);
	}
	
	public function getDataFechamentoAttribute($value) {
		return DateUtil::dateToView($value);
	}	

	public function setSaldoInicialAttribute($value) {
		$this->attributes['saldo_inicial'] = MoneyUtil::moneyToStorage($value);
	}
	
	public function getSaldoInicialAttribute($value) {
		return MoneyUtil::moneyToView($value);
	}	
	
	public function setTotalEntradasAttribute($value) {
		$this->attributes['total_entradas'] = MoneyUtil::moneyToStorage($value);
	}
	
	public function getTotalEntradasAttribute($value) {
		return MoneyUtil::moneyToView($value);
	}	
	
	public function setTotalSaidasAttribute($value) {
		$this->attributes['total_saidas'] = MoneyUtil::moneyToStorage($value);
	}
	
	public function getTotalSaidasAttribute($value) {
		return MoneyUtil::moneyToView($value);
	}	
	
	public function setSaldoFinalAttribute($value) {
		$this->attributes['saldo_final'] = MoneyUtil::moneyToStorage($value);
	}
	
	public function getSaldoFinalAttribute($value) {
		return MoneyUtil::moneyToView($value);
	}

	public static function getCaixaAberto() {
		return self::whereNull('data_fechamento')->first();
	}	
}