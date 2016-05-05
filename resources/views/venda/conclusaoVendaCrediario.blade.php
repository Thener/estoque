@extends('layout/default')

@section('conteudo')

<style>

.tableConclusao tr, .tableConclusao td {
	padding: 5px;
}

</style>

<div class="panel panel-primary">

	<div class="panel-heading">Conclusão Venda no Crediário</div>
	
	<div class="panel-body">
	
		<img src="/img/outros/check2.png">
		
		<div style="padding-bottom: 40px;"></div>
	
		<table class="tableConclusao">
			<tr>
				<td width="150px">Venda No.</td><td>{{ $venda->id }}</td>
			</tr>
			<tr>
				<td>Cliente</td><td>{{ $venda->cliente->nome }}</td>
			</tr>
			<tr>
				<td valign="top">Produtos</td>
				<td>
					@foreach ($venda->produtos as $vendaProduto)
						{{ $vendaProduto->produto->nome . '(' . $vendaProduto->quantidade . ')' }}
						&nbsp;&nbsp;&nbsp;
					@endforeach
				</td>				
			</tr>
			<tr>
				<td valign="top">Parcelas</td>
				<td>
					@foreach ($venda->parcelas as $vendaParcela)
						{{ $vendaParcela->numero_parcela . ')  R$ ' . $vendaParcela->valor_parcela . '  Vencimento: ' . $vendaParcela->data_vencimento }}
						<br /> 
					@endforeach
				</td>				
			</tr>			
		</table>

		<div style="padding-bottom: 40px;"></div>
		
		<button class="btn btn-primary" 
			onclick="javascript:window.location.href='/vendas'" type="button">
			Nova Venda
		</button>		
	
	</div>
	
</div>
	
@stop