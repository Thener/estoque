@extends('layout/default')

@section('conteudo')

<div class="panel panel-primary">

	<div class="panel-heading">Cadastro de Banco</div>
	
	<div class="panel-body">

		<form action="/gravarBanco" method="post">
		
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			
			<input type="hidden" name="id" value="{{ $banco->id }}" />
		
			<div class="form-group">
				<label>Nome</label>
				<input name="nome" value="{{ $banco->nome }}" class="form-control" />
			</div>
			
			<a class="btn btn-primary" href="/bancos/" role="button">Sair</a>
			
			@if (!$somenteLeitura)
				<button class="btn btn-primary" type="submit">Gravar</button>		
			@endif			
		</form>  
  
	</div>
	
</div>

@stop