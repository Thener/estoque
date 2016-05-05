@extends('layout/default')

@section('conteudo')

<div class="panel panel-primary">

	<div class="panel-heading">Cadastro de Produto</div>
	
	<div class="panel-body">

		<form action="/gravarProduto" method="post">
		
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			
			<input type="hidden" name="id" value="{{ $produto->id }}" />
		
			<div class="form-group">
				<label>Nome</label>
				<input name="nome" maxlength="100" value="{{ $produto->nome }}" class="form-control" />
			</div>
		
			<div class="form-group">
				<label>Nome Abreviado</label>
				<input name="nome_abreviado" maxlength="50" value="{{ $produto->nome_abreviado }}" class="form-control" />
			</div>
			
			<div class="form-group">
				<label>Categoria</label>
				{!! Form::select('categoria_id', $categorias, @$produto->categoria->id, array('class' => 'form-control')) !!}
			</div>
			
			<div class="form-group maskmoney" style="float:left;">
				<label>R$ Custo</label>
				<input name="preco_custo" value="{{ $produto->preco_custo }}" class="form-control maskMoney" />
			</div>
			
			<div class="form-group maskmoney" style="float:left; padding-left: 10px;">
				<label>R$ Venda</label>
				<input name="preco_venda" value="{{ $produto->preco_venda }}" class="form-control maskMoney" />
			</div>
			
			<div class="form-group" style="float:left; padding-left: 10px; width: 200px;">
				<label>Estoque Atual</label>
				<input name="estoque_atual" maxlength="50" value="{{ $produto->estoque_atual }}" class="form-control" />
			</div>			

			<div class="form-group" style="float:left; padding-left: 10px; width: 200px;">
				<label>Código de Barra</label>
				<input name="codigo_barra" maxlength="100" value="{{ $produto->codigo_barra }}" class="form-control" />
			</div>
			
			<div style="clear:both;"></div>
						
			<a class="btn btn-primary" href="/produtos/" role="button">Sair</a>
			
			@if (!$somenteLeitura)
				<button class="btn btn-primary" type="submit">Gravar</button>		
			@endif			
		</form>  
  
	</div>
	
</div>

@stop