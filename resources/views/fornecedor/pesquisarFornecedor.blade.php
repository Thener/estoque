@extends('layout/default')

@section('conteudo')

<div class="panel panel-primary">

	<div class="panel-heading">Fornecedores</div>
	
	<div class="panel-body">
	
		@include('fornecedor/gridFornecedor')
	
	</div>
	
</div>
	
@stop