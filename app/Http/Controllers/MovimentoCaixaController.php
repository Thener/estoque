<?php 

namespace App\Http\Controllers;

use App\Models\MovimentoCaixa;
use App\Models\Caixa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MovimentoCaixaController extends Controller {
	
	public function index() {
		return redirect()->action('MovimentoCaixaController@pesquisarMovimentoCaixa');
	}
		
	public function pesquisarMovimentoCaixa() {
		return view('movimentoCaixa/pesquisarMovimentoCaixa');
	}
	
	public function visualizarMovimentoCaixa($id) {
		return $this->formularioMovimentoCaixa(MovimentoCaixa::find($id), true);
	}
	
	public function incluirMovimentoCaixa() {
		
		if (!Caixa::getCaixaAberto()) {
			Session::flash('message','Não é possível incluir um movimento de caixa porque não existe caixa aberto.');
			return redirect()->back();
		}		
		
		return $this->formularioMovimentoCaixa(new MovimentoCaixa(), false);
	}
	
	public function alterarMovimentoCaixa($id) {
		
		$movimento = MovimentoCaixa::find($id);
		
		$caixa = Caixa::find($movimento->caixa_id);
		
		if ($caixa->data_fechamento) {
			Session::flash('message','Não é possível alterar o movimento porque o caixa no qual o mesmo foi lançado (' . $caixa->id . ') encontra-se fechado.');
			return redirect()->back();
		}

		return $this->formularioMovimentoCaixa($movimento, false);
	}
		
	public function gravarMovimentoCaixa(Request $request) {
		if ($request->input('id')) {
			$movimento = MovimentoCaixa::find($request->input('id'));
			$movimento->fill($request->all());
			$movimento->save();
		} else {
			$caixa = Caixa::getCaixaAberto();
			$movimento = new MovimentoCaixa();
			$movimento->fill($request->all());
			$movimento->caixa_id = $caixa->id;
			$movimento->user_id = Auth::user()->id;
			$movimento->save();
		}
		return $this->index();
	}
	
	public function excluirMovimentoCaixa($id) {
		$movimento = MovimentoCaixa::find($id);
		$movimento->delete();
		return $this->index();
	}
	
	public function formularioMovimentoCaixa($movimentoCaixa, $somenteLeitura) {
		
		return view('movimentoCaixa/formMovimentoCaixa',[
			'movimentoCaixa' => $movimentoCaixa,
			'somenteLeitura' => $somenteLeitura,
			'tiposMovimento' => MovimentoCaixa::getTiposMovimento()
		]);
	}
	
	public function grid(Request $request) {
		
		$movimentos = MovimentoCaixa::paginate($request);
		
		$data = array();
		
		$data['page'] 	= $request->input('page');
		$data['total'] 	= MovimentoCaixa::count();
		$data['rows'] 	= array();
		
		foreach($movimentos as $movimento) {
			
			if ($movimento->tipo_movimento == 'E') {
				$valor_entrada = '<span style="color:blue;">' . $movimento->valor_movimento . '</span>';
				$valor_saida = '';
			} else {
				$valor_entrada = '';
				$valor_saida = '<span style="color:red;">' . $movimento->valor_movimento . '</span>';				
			}
			
			$data['rows'][] = array(
					'id' => $movimento->id,
					'cell' => array(
						$movimento->id,
						$movimento->caixa_id,
						$movimento->descricao,
						$valor_entrada,
						$valor_saida
					)
			);
		}
		
		return json_encode($data);		
	}
	
}