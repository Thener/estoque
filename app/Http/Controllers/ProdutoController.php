<?php 

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Requests\ProdutoRequest;
use Illuminate\Support\Facades\DB;
use Response;

class ProdutoController extends Controller {
	
	public function index() {
		return redirect()->action('ProdutoController@pesquisarProduto');
	}
		
	public function pesquisarProduto() {
		return view('produto/pesquisarProduto');
	}
	
	public function visualizarProduto($id) {
		return $this->formularioProduto(Produto::find($id), true);
	}
	
	public function incluirProduto() {
		return $this->formularioProduto(new Produto(), false);
	}
	
	public function alterarProduto($id) {
		return $this->formularioProduto(Produto::find($id), false);
	}
		
	public function gravarProduto(ProdutoRequest $request) {
		if ($request->input('id')) {
			$produto = Produto::find($request->input('id'));
			$produto->fill($request->all());
			$produto->save();
		} else {
			Produto::create($request->all());
		}
		return $this->index();
	}
	
	public function excluirProduto($id) {
		$produto = Produto::find($id);
		$produto->delete();
		return $this->index();
	}
	
	public function formularioProduto($produto, $somenteLeitura) {

		return view('produto/formProduto',[
			'produto' => $produto,
			'somenteLeitura' => $somenteLeitura,
			'categorias' => Categoria::orderBy('nome','asc')->lists('nome', 'id')
		]);
	}
	
	public function grid(Request $request) {
		
		$produtos = Produto::paginate($request);
		
		$data = array();
		
		$data['page'] 	= $request->input('page');
		$data['total'] 	= Produto::count();
		$data['rows'] 	= array();
		
		foreach($produtos as $produto) {
			$data['rows'][] = array(
					'id' => $produto->id,
					'cell' => array(
						$produto->id,
						$produto->nome,
						$produto->nome_abreviado,
						$produto->categoria->nome,
						$produto->preco_venda,
						$produto->estoque_atual
					)
			);
		}
		
		return json_encode($data);		
	}
	
	public function autoCompleteNomeProduto(Request $request) {
		
		$pesq = $request->input('query') . '%';
		
		$produtos = Produto::where('nome', 'ilike', $pesq)->get();
		
		$dados = array();
		
		foreach ($produtos as $produto) {
			$dados[] = array(
				'value' => $produto->nome, 
				'data' => array(
					'id' => $produto->id,
					'preco_venda' => $produto->preco_venda
				)
			);
		}
		
		$in = array("suggestions" => $dados);
		
		return Response::json($in);
	}
	
	public function recuperarProdutoPorId($id) {
		
		$produto = Produto::find($id);
		
		return Response::json($produto);
	}

}