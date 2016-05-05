@extends('layout/default')

@section('conteudo')

<div class="panel panel-primary">

	<div class="panel-heading">Clientes</div>
	
	<div class="panel-body">
	
		@include('cliente/gridCliente')
	
	</div>
	
</div>
	
@stop