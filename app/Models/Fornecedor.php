<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Fornecedor extends Model {
    
	protected $table = 'fornecedor';
	
	protected $fillable = array (
			'nome',
			'end_logradouro',
			'end_numero',
			'end_complemento',
			'end_bairro',
			'end_cidade',
			'end_uf',
			'end_cep',
			'telefone_fixo',
			'telefone_celular',
			'email' 
	);
	
	public static function paginate($request) {
	
		$page 		= $request->input('page');
		$rp 		= $request->input('rp');
		$sortname 	= $request->input('sortname');
		$pesquisa 	= $request->input('query') . '%';
		$sortorder 	= $request->input('sortorder');
		$qtype 		= $request->input('qtype');
		$filtros 	= $request->input('filtros');
	
		$offset = ($page == 1) ? 0 : ($page-1) * $rp;
	
		return Fornecedor::
		orderBy($sortname, $sortorder)
		->offset($offset)
		->limit($rp)
		->where($qtype, 'ilike', $pesquisa)
		->get();
	}
}