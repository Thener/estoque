<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produto extends Model {
    
	protected $table = 'produto';
	
	protected $fillable = array(
		'nome',
		'nome_abreviado',
		'categoria_id',
		'preco_custo',
		'preco_venda',
		'codigo_barra',
		'estoque_atual'
	);
	
	public function categoria() {
		return $this->belongsTo('App\Models\Categoria');
	}
	
	public static function paginate($request) {
		
		$page 		= $request->input('page');
		$rp 		= $request->input('rp');
		$sortname 	= $request->input('sortname');
		$pesquisa 	= $request->input('query') . '%';
		$sortorder 	= $request->input('sortorder');
		$qtype 		= $request->input('qtype');
		$filtros 	= $request->input('filtros');		
		
		$offset = ($page == 1) ? 0 : ($page-1) * $rp;
		
		return Produto::with('categoria')
			->orderBy($sortname, $sortorder)
			->offset($offset)
			->limit($rp)
			->where($qtype, 'ilike', $pesquisa)
			->get();		
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
	
	public function setEstoqueAtualAttribute($value) {
		$this->attributes['estoque_atual'] = $value == '' ? null : $value;
	}
	
}
