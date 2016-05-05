@extends('layout/default')

@section('conteudo')

<div class="panel panel-primary">

	<div class="panel-heading">Cadastro de Cliente</div>
	
	<div class="panel-body">

		<form action="/gravarCliente" method="post">
		
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			
			<input type="hidden" name="id" value="{{ $cliente->id }}" />
		
			<div class="form-group">
				<label>Nome</label>
				<input name="nome" value="{{ $cliente->nome }}" class="form-control" />
			</div>
			
			<a class="btn btn-primary" href="/clientes/" role="button">Sair</a>
			
			@if (!$somenteLeitura)
				<button class="btn btn-primary" type="submit">Gravar</button>		
			@endif			
		</form>  
  
	</div>
	
</div>

@stop