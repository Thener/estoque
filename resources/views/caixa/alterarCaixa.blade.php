@extends('layout/default')

@section('conteudo')

<div class="panel panel-primary">

	<div class="panel-heading">Alterar Caixa</div>
	
	<div class="panel-body">

		<form action="/gravarCaixa" method="post">
		
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			
			<input type="hidden" name="id" value="{{ $caixa->id }}" />
			
			<fieldset>
				<legend>Informações:</legend>
				<table>
					<tr>
						<td width="100px;">Número:</td>
						<td>{{ $caixa->id }}</td>
					</tr>			
					<tr>
						<td>Data:</td>
						<td>{{ $caixa->data_caixa }}</td>
					</tr>
					<tr>
						<td>Aberto por:</td>
						<td>{{ $caixa->aberto_por }}</td>
					</tr>
					<tr>
						<td>Fechado por:</td>
						<td>{{ $caixa->fechado_por }}</td>
					</tr>
				</table>
			</fieldset>

			<hr />						
			
			<div class="form-group maskmoney" style="float:left;">
				<label>Saldo Inicial</label>
				<input name="saldo_inicial" value="{{ $caixa->saldo_inicial }}" 
					id="saldoInicial" class="form-control maskMoney" />
			</div>
			
			<div class="form-group maskmoney" style="float:left; padding-left:10px;">
				<label>Total Entradas</label>
				<input name="total_entradas" value="{{ $caixa->total_entradas }}"
					id="totalEntradas" class="form-control maskMoney" />
			</div>
			
			<div class="form-group maskmoney" style="float:left; padding-left:10px;">
				<label>Total Saídas</label>
				<input name="total_saidas" value="{{ $caixa->total_saidas }}"
					id="totalSaidas" class="form-control maskMoney" />
			</div>
			
			<div class="form-group maskmoney" style="float:left; padding-left:10px;">
				<label>Saldo Final</label>
				<input name="saldo_final" value="{{ $caixa->saldo_final }}"
					id="saldoFinal" class="form-control maskMoney" readonly/>
			</div>	
			
			<div style="clear:both;"></div>
		    
			<a class="btn btn-primary" href="/caixas" role="button">Sair</a>
			
			<button class="btn btn-primary" type="submit">Alterar</button>		    

		</form>  
  
	</div>
	
</div>

<script>

	$('#saldoInicial,#totalEntradas,#totalSaidas').change(function(){
		calcularSaldoFinal();
	});

	function calcularSaldoFinal() {

		var saldoInicial = moedaDesformatar($('#saldoInicial').val());
		var totalEntradas = moedaDesformatar($('#totalEntradas').val());
		var totalSaidas = moedaDesformatar($('#totalSaidas').val());

		var saldoFinal = saldoInicial + totalEntradas - totalSaidas;

		$('#saldoFinal').val(moedaFormatar(saldoFinal));
	}

</script>
	
@stop