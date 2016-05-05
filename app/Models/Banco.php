<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model {
    
	protected $table = 'banco';
	
	protected $fillable = array(
			'nome'
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
	
		return Banco::
		orderBy($sortname, $sortorder)
		->offset($offset)
		->limit($rp)
		->where($qtype, 'ilike', $pesquisa)
		->get();
	}
}