<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimentoCaixa extends Model {
    
	protected $table = 'movimento_caixa';
	
	protected $fillable = [
			'caixa_id',
			'descricao',
			'tipo_movimento',
			'valor_movimento',
			'user_id',
			'venda_id'
	];

	public static function paginate($request) {
	
		$page 		= $request->input('page');
		$rp 		= $request->input('rp');
		$sortname 	= $request->input('sortname');
		$pesquisa 	= $request->input('query') . '%';
		$sortorder 	= $request->input('sortorder');
		$qtype 		= $request->input('qtype');
		$filtros 	= $request->input('filtros');
	
		$offset = ($page == 1) ? 0 : ($page-1) * $rp;
	
		return MovimentoCaixa::orderBy($sortname, $sortorder)
			->offset($offset)
			->limit($rp)
			->where($qtype, 'ilike', $pesquisa)
			->get();
	}
		
	public static function getTiposMovimento() {
		return array(
				'E' => 'Entrada',
				'S' => 'Saída'
		);
	}
	
	public function getNomeTipoMovimento() {
		$itens = self::getTiposMovimento();
		return $itens[$this->tipo_movimento];
	}
	
	public function setValorMovimentoAttribute($value) {
		$this->attributes['valor_movimento'] = MoneyUtil::moneyToStorage($value);
	}
	
	public function getValorMovimentoAttribute($value) {
		return MoneyUtil::moneyToView($value);
	}	
		
}