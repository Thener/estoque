<?php 

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Requests\ClienteRequest;
use Illuminate\Support\Facades\DB;
use Response;

class ClienteController extends Controller {
	
	public function index() {
		return redirect()->action('ClienteController@pesquisarCliente');
	}
		
	public function pesquisarCliente() {
		return view('cliente/pesquisarCliente');
	}
	
	public function visualizarCliente($id) {
		return $this->formularioCliente(Cliente::find($id), true);
	}
	
	public function incluirCliente() {
		return $this->formularioCliente(new Cliente(), false);
	}
	
	public function alterarCliente($id) {
		return $this->formularioCliente(Cliente::find($id), false);
	}
		
	public function gravarCliente(ClienteRequest $request) {
		if ($request->input('id')) {
			$cliente = Cliente::find($request->input('id'));
			$cliente->fill($request->all());
			$cliente->save();
		} else {
			Cliente::create($request->all());
		}
		return $this->index();
	}
	
	public function excluirCliente($id) {
		$cliente = Cliente::find($id);
		$cliente->delete();
		return $this->index();
	}
	
	public function formularioCliente($cliente, $somenteLeitura) {
		return view('cliente/formCliente',[
			'cliente' => $cliente,
			'somenteLeitura' => $somenteLeitura
		]);
	}
	
	public function grid(Request $request) {
		
		$clientes = Cliente::paginate($request);
		
		$data = array();
		
		$data['page'] 	= $request->input('page');
		$data['total'] 	= Cliente::count();
		$data['rows'] 	= array();
		
		foreach($clientes as $cliente) {
			$data['rows'][] = array(
					'id' => $cliente->id,
					'cell' => array(
						$cliente->id,
						$cliente->nome						
					)
			);
		}
		
		return json_encode($data);		
	}
	
	public function recuperarClienteJsonPorCpf($cpf) {
		
		$cliente = Cliente::where('cpf', $cpf)->first();
		
		return json_encode($cliente);
	}
	
	public function autoCompleteNomeCliente(Request $request) {
	
		$pesq = $request->input('query') . '%';
	
		$clientes = Cliente::where('nome', 'ilike', $pesq)->get();
	
		$dados = array();
	
		foreach ($clientes as $cliente) {
			$dados[] = array(
				'value' => $cliente->nome,
				'data' => $cliente
			);
		}
	
		$in = array("suggestions" => $dados);
	
		return Response::json($in);
	}	
	
}