@extends('layout/default')

@section('conteudo')

	<div class="panel-body">
		
		<div id="vender" class="iconeHome iconeHomeCalculadora">
			Vendas
		</div>
		
		<div id="troca" class="iconeHome iconeHomeTroca">
			Troca
		</div>
				
		<div id="movimentoCaixa" class="iconeHome iconeHomeCalculadora2">
			Movimento
		</div>	
		
		<div id="caixa" class="iconeHome iconeHomeMoney">
			Caixa
		</div>
		
		<div id="resumo" class="iconeHome iconeHomeResumo">
			Resumo
		</div>		
		
	</div>
	
	<script>

		$('#vender').click(function(){
			window.location.href='/vendas';
		});

		$('#movimentoCaixa').click(function(){
			window.location.href='/movimentosCaixa';
		});	

		$('#caixa').click(function(){
			window.location.href='/caixas';
		});				

	</script>

@endsection