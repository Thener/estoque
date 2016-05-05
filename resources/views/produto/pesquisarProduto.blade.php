@extends('layout/default')

@section('conteudo')

<div class="panel panel-primary">

	<div class="panel-heading">Produtos</div>
	
	<div class="panel-body">
	
		@include('produto/gridProduto')
	
	</div>
	
</div>
	
@stop