@extends('layout/default')

@section('conteudo')

<div class="panel panel-primary">

	<div class="panel-heading">Movimento de Caixa</div>
	
	<div class="panel-body">

		<form action="/gravarMovimentoCaixa" method="post">
		
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			
			<input type="hidden" name="id" value="{{ $movimentoCaixa->id }}" />
			<input type="hidden" name="caixa_id" value="{{ $movimentoCaixa->caixa_id }}" />
			@if ($movimentoCaixa->venda_id)
				<input type="hidden" name="venda_id" value="{{ $movimentoCaixa->venda_id }}" />
			@endif
			
			<div class="form-group">
				<label>Descrição</label>
				<input name="descricao" value="{{ $movimentoCaixa->descricao }}" 
					maxlength="100" class="form-control" />
			</div>
			
			<div class="form-group">
				<label>Tipo de Movimento</label>
				{!! Form::select('tipo_movimento', $tiposMovimento, @$movimentoCaixa->tipo_movimento, array('class' => 'form-control')) !!}
			</div>
			
			<div class="form-group maskmoney">
				<label>Valor do Movimento</label>
				<input name="valor_movimento" value="{{ $movimentoCaixa->valor_movimento }}" class="form-control maskMoney" />
			</div>
			
			<a class="btn btn-primary" href="/movimentosCaixa/" role="button">Sair</a>
			
			@if (!$somenteLeitura)
				<button class="btn btn-primary" type="submit">Gravar</button>		
			@endif
		</form>  
  
	</div>
	
</div>

@stop