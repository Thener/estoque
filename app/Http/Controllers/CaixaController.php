<?php 

namespace App\Http\Controllers;

use App\Models\Caixa;
use App\Models\MovimentoCaixa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DateUtil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\MoneyUtil;

class CaixaController extends Controller {
	
	public function index() {
		return redirect()->action('CaixaController@pesquisarCaixa');
	}
		
	public function pesquisarCaixa() {
		return view('caixa/pesquisarCaixa');
	}
	
	public function abrirCaixa() {
		
		$caixa = Caixa::getCaixaAberto();
		
		if ($caixa) {
			Session::flash('message','Não é possível abrir novo caixa porque o caixa de número ' . $caixa->id . ' ainda está aberto.');
			return redirect()->back();
		}
		
		return view('caixa/abrirCaixa',['hoje' => DateUtil::today()]);
	}
	
	public function alterarCaixa($id) {
		return view('caixa/alterarCaixa',['caixa' => Caixa::find($id)]);
	}	
	
	public function fecharCaixa($id) {
		
		$caixa = Caixa::find($id);
		
		if ($caixa->data_fechamento) {
			Session::flash('message','Caixa de número ' . $caixa->id . ' já está fechado.');
			return redirect()->back();
		}
		
		$totalEntradas = MovimentoCaixa::where('caixa_id', $caixa->id)
			->where('tipo_movimento', 'E')
			->sum('valor_movimento');

		$totalSaidas = MovimentoCaixa::where('caixa_id', $caixa->id)
			->where('tipo_movimento', 'S')
			->sum('valor_movimento');

		$saldoFinal = MoneyUtil::moneyToStorage($caixa->saldo_inicial) + $totalEntradas - $totalSaidas; 
				
		return view('caixa/fecharCaixa',[
			'caixa' => $caixa,
			'hoje' => DateUtil::today(),
			'totalEntradas' => MoneyUtil::moneyToView($totalEntradas),
			'totalSaidas' => MoneyUtil::moneyToView($totalSaidas),
			'saldoFinal' => MoneyUtil::moneyToView($saldoFinal)
		]);
	}	
	
	public function efetuarFechamentoCaixa(Request $request) {
		
		$caixa = Caixa::find($request->input('id'));
		$caixa->fill($request->all());
		$caixa->fechado_por = Auth::user()->name;
		$caixa->data_fechamento = DateUtil::today();
		$caixa->save();
		
		return $this->index();
	}
		
	public function gravarCaixa(Request $request) {
		
		if ($request->input('id')) {
			$caixa = Caixa::find($request->input('id'));
			$caixa->fill($request->all());
			$caixa->save();
		} else {
			$caixa = new Caixa();
			$caixa->saldo_inicial = $request->input('saldo_inicial');
			$caixa->saldo_final = $caixa->saldo_inicial;
			$caixa->aberto_por = Auth::user()->name;
			$caixa->data_caixa = $request->input('data_caixa');
			$caixa->save();
		}
		return $this->index();
	}
	
	public function excluirCaixa($id) {
		$caixa = Caixa::find($id);
		$caixa->delete();
		return $this->index();
	}
	
	public function grid(Request $request) {
		
		$caixas = Caixa::paginate($request);
		
		$data = array();
		
		$data['page'] 	= $request->input('page');
		$data['total'] 	= Caixa::count();
		$data['rows'] 	= array();
		
		foreach($caixas as $caixa) {
			
			$color = ($caixa->data_fechamento) ? 'black' : 'blue';
			$span = "<span style='color:$color;'>";
			$fspan = '</span>';
			
			$data['rows'][] = array(
					'id' => $caixa->id,
					'cell' => array(
						$span . $caixa->id . $fspan,
						$span . $caixa->data_caixa . $fspan,
						$span . $caixa->aberto_por . $fspan,
						$span . $caixa->saldo_inicial . $fspan,
						$span . $caixa->total_entradas . $fspan,
						$span . $caixa->total_saidas . $fspan,
						$span . $caixa->saldo_final . $fspan,
						$span . $caixa->data_fechamento . $fspan,
						$span . $caixa->fechado_por . $fspan
					)
			);
		}
		
		return json_encode($data);		
	}
	
}