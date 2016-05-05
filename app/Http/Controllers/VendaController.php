<?php 

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Caixa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\MoneyUtil;
use App\Models\DateUtil;
use App\Models\Produto;
use App\Models\VendaProduto;
use App\Models\VendaParcela;
use App\Models\MovimentoCaixa;
use Illuminate\Support\Facades\Auth;
use App\Models\Cliente;
use App\Models\ValidadorUtil;

class VendaController extends Controller {
	
	public function vender() {
		
		if (!Caixa::getCaixaAberto()) {
			Session::flash('message','Não é possível realizar uma venda porque não existe caixa aberto.');
			return redirect()->back();
		}
		
		return view('venda/vender',[
			'tiposVenda' => Venda::getTiposVenda(true)
		]);
	}
		
	public function incluirProdutoVenda(Request $request) {

		$produto_id 	= $request->input('produto_id');
		$produto_nome 	= $request->input('produto_nome');
		$quantidade 	= $request->input('quantidade');
		$preco_venda 	= $request->input('preco_venda');
		$total_item 	= $quantidade * MoneyUtil::moneyToStorage($preco_venda);
		
		$listaProdutos = $request->session()->get('listaProdutos');
		
		$produto = Produto::find($produto_id);
		
		if ($produto_id && $preco_venda) {
			
			$listaProdutos[] = array(
				'id' => $produto_id,
				'nome' => $produto_nome,
				'quantidade' => $quantidade,
				'preco_venda' => $preco_venda,
				'preco_custo' => $produto->preco_custo,
				'total_item' => MoneyUtil::moneyToView($total_item)
			);
		
		}
		
		$request->session()->set('listaProdutos', $listaProdutos);
		
		//return $this->listarProdutosVenda($request);
	}
	
	public function excluirProdutoVenda(Request $request, $key) {
	
		$listaProdutos = $request->session()->get('listaProdutos');
		
		unset($listaProdutos[$key]);
		
		if (count($listaProdutos) == 0) {
			$request->session()->set('valorDescontoVenda', null);
			$request->session()->set('percentualDescontoVenda', null);
			$request->session()->set('totalPagar', null);
			$request->session()->set('totalVenda', null);
		}
	
		$request->session()->set('listaProdutos', $listaProdutos);

		return $this->listarProdutosVenda($request);
	}	
	
	public function listarProdutosVenda(Request $request, $options = array()) {
		
		$lista = $request->session()->get('listaProdutos');
		
		$valor_desconto = isset($options['valor_desconto']) ? 
			MoneyUtil::moneyToStorage($options['valor_desconto']) : $request->session()->get('valorDescontoVenda');
		
		$percentual_desconto = isset($options['percentual_desconto']) ? 
			MoneyUtil::moneyToStorage($options['percentual_desconto']) : $request->session()->get('percentualDescontoVenda');
		
		if (count($lista) == 0)
			return;
		
		$total_itens = 0;
		$qtde_total = 0;
		
		foreach ($lista as $prod) {
			$total_itens += MoneyUtil::moneyToStorage($prod['total_item']);
			$qtde_total += $prod['quantidade'];
		}
		
		$total_pagar = $total_itens;
		
		if ($valor_desconto) {
			$total_pagar -= $valor_desconto; 
			$percentual_desconto = null;
		} else if ($percentual_desconto) {
			$total_pagar -= (($percentual_desconto/100) * $total_pagar);
			$valor_desconto = null;
		}
		
		$request->session()->set('valorDescontoVenda', $valor_desconto);
		$request->session()->set('percentualDescontoVenda', $percentual_desconto);
		$request->session()->set('totalVenda', $total_itens);
		$request->session()->set('totalPagar', $total_pagar);
		
		return view('venda/listarProdutos',[
			'produtos' 				=> $lista,
			'total_venda' 			=> 'R$ ' . MoneyUtil::moneyToView($total_itens),
			'qtde_total' 			=> $qtde_total,
			'total_pagar' 			=> 'R$ ' . MoneyUtil::moneyToView($total_pagar),
			'valor_desconto' 		=> MoneyUtil::moneyToView($valor_desconto),
			'percentual_desconto' 	=> MoneyUtil::moneyToView($percentual_desconto)
		]);		
	}
	
	public function atualizarProdutoVenda(Request $request, $key, $quantidade) {
	
		$listaProdutos = $request->session()->get('listaProdutos');
	
		$listaProdutos[$key]['quantidade'] = $quantidade;
		$listaProdutos[$key]['total_item'] = 
			MoneyUtil::moneyToView($quantidade * MoneyUtil::moneyToStorage($listaProdutos[$key]['preco_venda']));
	
		$request->session()->set('listaProdutos', $listaProdutos);
	
		return $this->listarProdutosVenda($request);
	}

	public function excluirTodosProdutosVenda(Request $request) {

		$this->excluirProdutos($request);
		
		return $this->listarProdutosVenda($request);		
	}
	
	public function excluirProdutos(Request $request) {
		
		$request->session()->set('listaProdutos', null);
		$request->session()->set('valorDescontoVenda', null);
		$request->session()->set('percentualDescontoVenda', null);
		$request->session()->set('totalPagar', null);
		$request->session()->set('totalVenda', null);
	}
	
	public function incluirValorDescontoVenda(Request $request, $valorDesconto = 0) {
		
		$options['valor_desconto'] = $valorDesconto;
		
		return $this->listarProdutosVenda($request, $options);
	}
	
	public function incluirPercentualDescontoVenda(Request $request, $percentualDesconto = 0) {
	
		$options['percentual_desconto'] = $percentualDesconto;
	
		return $this->listarProdutosVenda($request, $options);
	}

	public function finalizarVendaDinheiro(Request $request) {

		$this->salvarVendaProdutos($request, [
			'tipo_venda' => 'DIN',
			'limpar_venda' => true
		]);
		
		return redirect()->action('VendaController@vender');
	}
	
	public function finalizarVendaCartao(Request $request) {
	
		$this->salvarVendaProdutos($request, [
			'tipo_venda' => 'CAR',
			'limpar_venda' => true
		]);
	
		return redirect()->action('VendaController@vender');
	}
	
	public function finalizarVendaCrediario(Request $request, $cliente_id) {
	
		$venda = $this->salvarVendaProdutos($request, [
			'tipo_venda' => 'CRE',
			'limpar_venda' => true,
			'cliente_id' => $cliente_id
		]);
		
		return view('venda/conclusaoVendaCrediario',[
			'venda' => $venda
		]);
	}	
	
	public function salvarVendaProdutos(Request $request, $options = array()) {
		
		DB::beginTransaction();
		
		try {
		
			$tipo_venda = $options['tipo_venda'];
			$limpar_venda = $options['limpar_venda'];
			$cliente_id = isset($options['cliente_id']) ? $options['cliente_id'] : null; 
			
			$caixa = Caixa::getCaixaAberto();
			
			$valor_desconto = $request->session()->get('valorDescontoVenda');
			$percentual_desconto = $request->session()->get('percentualDescontoVenda');
			$total_pagar = $request->session()->get('totalPagar');
			$total_venda = $request->session()->get('totalVenda');
			
			$venda = new Venda();
			
			$venda->caixa_id 				= $caixa->id;
			$venda->data_venda 				= DateUtil::today('Y-m-d');
			$venda->tipo_venda 				= $tipo_venda;
			$venda->valor_desconto 			= $valor_desconto;
			$venda->percentual_desconto 	= $percentual_desconto;
			$venda->total_venda 			= $total_venda;
			$venda->total_pagar 			= $total_pagar;
			
			if ($cliente_id) {
				$venda->cliente_id = $cliente_id;
			}
			
			//----------------------------------- Salvar a venda:
			
			$venda->save();
			
			//----------------------------------- Salvar os produtos da venda:
			
			$listaProdutos = $request->session()->get('listaProdutos');
			$produtosVenda = array();
			
			foreach ($listaProdutos as $prod) {
				$produtosVenda[] = new VendaProduto([
					'produto_id' 	=> $prod['id'],
					'preco_custo' 	=> $prod['preco_custo'],
					'preco_venda' 	=> $prod['preco_venda'],
					'quantidade' 	=> $prod['quantidade'],
					'preco_item' 	=> $prod['total_item']
				]);
			}
			
			$venda->produtos()->saveMany($produtosVenda);
			
			//------------------------------------ Registrar Parcelas (Crediário):
			
			if ($tipo_venda == 'CRE') {
				
				$listaParcelas = $request->session()->get('listaParcelas');
				$parcelasVenda = array();
				
				foreach ($listaParcelas as $parc) {
					$parcelasVenda[] = new VendaParcela([
						'numero_parcela' 	=> $parc['numero_parcela'],
						'valor_parcela' 	=> $parc['valor_parcela'],
						'data_vencimento' 	=> $parc['data_vencimento']
					]);
				}
				
				$venda->parcelas()->saveMany($parcelasVenda);
			}
			
			//------------------------------------ Registrar Movimento de Caixa:
			
			if ($tipo_venda == 'DIN') {
				
				$movimentoCaixa = new MovimentoCaixa();
				
				$movimentoCaixa->caixa_id = $caixa->id;
				$movimentoCaixa->user_id = Auth::user()->id;
				$movimentoCaixa->venda_id = $venda->id;
				$movimentoCaixa->descricao = 'Venda';
				$movimentoCaixa->tipo_movimento = 'E';
				$movimentoCaixa->valor_movimento = $venda->total_pagar;
				
				$movimentoCaixa->save();
			}
	
			if ($limpar_venda) {
				$this->excluirProdutos($request);
			}
			
			DB::commit();
			
			return $venda;
			
		} catch (\Exception $e) {
			DB::rollback();
			
			return null;
		}
	}
	
	public function informacoesVenda(Request $request) {

		$listaProdutos = $request->session()->get('listaProdutos');
		
		$info['qtde_itens'] = count($listaProdutos);
		
		return json_encode($info);
	}
	
	public function gravarClienteVenda(Request $request) {
		
		if ($request->input('cpf') == '') {
			return json_encode([
				'sucesso' => false,
				'mensagem' => 'Cpf deve ser informado!'
			]);	
		}
		
		if ($request->input('nome') == '') {
			return json_encode([
				'sucesso' => false,
				'mensagem' => 'Nome deve ser informado!'
			]);
		}
		
		if (!ValidadorUtil::validaCpf($request->input('cpf'))) {
			return json_encode([
				'sucesso' => false,
				'mensagem' => 'Erro: Número de CPF inválido!'
			]);
		}		
		
		if ($request->input('id')) {
			$cliente = Cliente::where('cpf', $request->input('cpf'))->where('id','<>',$request->input('id'))->first();
		} else {
			$cliente = Cliente::where('cpf', $request->input('cpf'))->first();
		}
		
		if ($cliente) {
			return json_encode([
				'sucesso' => false,
				'mensagem' => 'Erro: Cliente ' . $cliente->nome . ' já está cadastrado com este CPF!'
			]);			
		}
		
		if ($request->input('id')) {
			$cliente = Cliente::find($request->input('id'));
		} else{
			$cliente = new Cliente();
		}
		$cliente->fill($request->all());
		$cliente->save();
				
		return json_encode([
			'clienteId' => $cliente->id,
			'sucesso' => true
		]);
	}
	
	public function calcularParcelamento(Request $request) {
		
		$total_pagar 	= $request->session()->get('totalPagar');
		$parcelas 		= $request->input('qtdeParcelas');
		$primeiroVenc 	= $request->input('vencParc1');
		
		if (!$total_pagar) {
			return view('venda/erro',[
				'erro' => true,
				'mensagem' => 'Erro: Valor a pagar inválido!'
			]);
		}

		if (!$parcelas) {
			return view('venda/erro',[
				'erro' => true,
				'mensagem' => 'Erro: Número de parcelas deve ser informado!'
			]);
		}

		if (!$primeiroVenc) {
			return view('venda/erro',[
				'erro' => true,
				'mensagem' => 'Erro: Data do primeiro vencimento deve ser informada!'
			]);
		}
		
		$listaParcelas = array();
		
		$valorParcela = $total_pagar / $parcelas;
		
		for ($i=0; $i < $parcelas; $i++) {

			$parc = $i + 1;
			
			$listaParcelas[] = [
				'numero_parcela' => $parc,
				'valor_parcela' => MoneyUtil::moneyToView($valorParcela),
				'data_vencimento' => $primeiroVenc
			];
			
			$primeiroVenc = DateUtil::addMonths($primeiroVenc, 1);			
		}
		
		$request->session()->set('listaParcelas', $listaParcelas);

		return $this->listarParcelamentoVenda($request);
	}
	
	public function listarParcelamentoVenda(Request $request) {
		
		$listaParcelas = $request->session()->get('listaParcelas');
		
		$valorTotalParcelado = 0;
		
		foreach ($listaParcelas as $parc) {
			$valorTotalParcelado += MoneyUtil::moneyToStorage($parc['valor_parcela']);
		}
		
		$total_pagar = $request->session()->get('totalPagar');
		
		if (MoneyUtil::moneyCompare($valorTotalParcelado, $total_pagar) < 0) {
			$diferenca = MoneyUtil::moneySubtract($total_pagar, $valorTotalParcelado);
			$parcela1 = MoneyUtil::moneySum($listaParcelas[0]['valor_parcela'], $diferenca);
			$listaParcelas[0]['valor_parcela'] = MoneyUtil::moneyToView($parcela1);
			$request->session()->set('listaParcelas', $listaParcelas);
			// recalcula total parcelado
			$valorTotalParcelado = 0;
			foreach ($listaParcelas as $parc) {
				$valorTotalParcelado += MoneyUtil::moneyToStorage($parc['valor_parcela']);
			}			
		}
		
		if (MoneyUtil::moneyCompare($valorTotalParcelado, $total_pagar) > 0) {
			$diferenca = MoneyUtil::moneySubtract($valorTotalParcelado, $total_pagar);
			$parcela1 = MoneyUtil::moneySubtract($listaParcelas[0]['valor_parcela'], $diferenca);
			$listaParcelas[0]['valor_parcela'] = MoneyUtil::moneyToView($parcela1);
			$request->session()->set('listaParcelas', $listaParcelas);
			// recalcula total parcelado
			$valorTotalParcelado = 0;
			foreach ($listaParcelas as $parc) {
				$valorTotalParcelado += MoneyUtil::moneyToStorage($parc['valor_parcela']);
			}
		}		
		
		return view('venda/calculoParcelamento',[
			'listaParcelas' => $listaParcelas,
			'valorTotalParcelado' => MoneyUtil::moneyToView($valorTotalParcelado)
		]);		
	}
	
}