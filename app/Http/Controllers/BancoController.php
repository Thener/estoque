<?php 

namespace App\Http\Controllers;

use App\Models\Banco;
use Illuminate\Http\Request;
use App\Http\Requests\BancoRequest;
use Illuminate\Support\Facades\DB;

class BancoController extends Controller {
	
	public function index() {
		return redirect()->action('BancoController@pesquisarBanco');
	}
		
	public function pesquisarBanco() {
		return view('banco/pesquisarBanco');
	}
	
	public function visualizarBanco($id) {
		return $this->formularioBanco(Banco::find($id), true);
	}
	
	public function incluirBanco() {
		return $this->formularioBanco(new Banco(), false);
	}
	
	public function alterarBanco($id) {
		return $this->formularioBanco(Banco::find($id), false);
	}
		
	public function gravarBanco(BancoRequest $request) {
		if ($request->input('id')) {
			$banco = Banco::find($request->input('id'));
			$banco->fill($request->all());
			$banco->save();
		} else {
			Banco::create($request->all());
		}
		return $this->index();
	}
	
	public function excluirBanco($id) {
		$banco = Banco::find($id);
		$banco->delete();
		return $this->index();
	}
	
	public function formularioBanco($banco, $somenteLeitura) {
		return view('banco/formBanco',[
			'banco' => $banco,
			'somenteLeitura' => $somenteLeitura
		]);
	}
	
	public function grid(Request $request) {
		
		$bancos = Banco::paginate($request);
		
		$data = array();
		
		$data['page'] 	= $request->input('page');
		$data['total'] 	= Banco::count();
		$data['rows'] 	= array();
		
		foreach($bancos as $banco) {
			$data['rows'][] = array(
					'id' => $banco->id,
					'cell' => array(
						$banco->id,
						$banco->nome						
					)
			);
		}
		
		return json_encode($data);		
	}
	
}