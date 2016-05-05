<?php 

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;
use App\Http\Requests\FornecedorRequest;
use Illuminate\Support\Facades\DB;
use Response;

class FornecedorController extends Controller {
	
	public function index() {
		return redirect()->action('FornecedorController@pesquisarFornecedor');
	}
		
	public function pesquisarFornecedor() {
		return view('fornecedor/pesquisarFornecedor');
	}
	
	public function visualizarFornecedor($id) {
		return $this->formularioFornecedor(Fornecedor::find($id), true);
	}
	
	public function incluirFornecedor() {
		return $this->formularioFornecedor(new Fornecedor(), false);
	}
	
	public function alterarFornecedor($id) {
		return $this->formularioFornecedor(Fornecedor::find($id), false);
	}
		
	public function gravarFornecedor(FornecedorRequest $request) {
		if ($request->input('id')) {
			$fornecedor = Fornecedor::find($request->input('id'));
			$fornecedor->fill($request->all());
			$fornecedor->save();
		} else {
			Fornecedor::create($request->all());
		}
		return $this->index();
	}
	
	public function excluirFornecedor($id) {
		$fornecedor = Fornecedor::find($id);
		$fornecedor->delete();
		return $this->index();
	}
	
	public function formularioFornecedor($fornecedor, $somenteLeitura) {
		return view('fornecedor/formFornecedor',[
			'fornecedor' => $fornecedor,
			'somenteLeitura' => $somenteLeitura
		]);
	}
	
	public function grid(Request $request) {
		
		$fornecedores = Fornecedor::paginate($request);
		
		$data = array();
		
		$data['page'] 	= $request->input('page');
		$data['total'] 	= Fornecedor::count();
		$data['rows'] 	= array();
		
		foreach($fornecedores as $fornecedor) {
			$data['rows'][] = array(
					'id' => $fornecedor->id,
					'cell' => array(
						$fornecedor->id,
						$fornecedor->nome						
					)
			);
		}
		
		return json_encode($data);		
	}
	
	public function recuperarFornecedorJsonPorCpf($cpf) {
		
		$fornecedor = Fornecedor::where('cpf', $cpf)->first();
		
		return json_encode($fornecedor);
	}
	
	public function autoCompleteNomeFornecedor(Request $request) {
	
		$pesq = $request->input('query') . '%';
	
		$fornecedors = Fornecedor::where('nome', 'ilike', $pesq)->get();
	
		$dados = array();
	
		foreach ($fornecedors as $fornecedor) {
			$dados[] = array(
				'value' => $fornecedor->nome,
				'data' => $fornecedor
			);
		}
	
		$in = array("suggestions" => $dados);
	
		return Response::json($in);
	}	
	
}