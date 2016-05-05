@extends('layout/default')

@section('conteudo')

<div class="panel panel-primary">

	<div class="panel-heading">Movimento de Caixa</div>
	
	<div class="panel-body">
	
		@include('movimentoCaixa/gridMovimentoCaixa')
	
	</div>
	
</div>
	
@stop