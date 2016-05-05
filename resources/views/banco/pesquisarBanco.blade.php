@extends('layout/default')

@section('conteudo')

<div class="panel panel-primary">

	<div class="panel-heading">Bancos</div>
	
	<div class="panel-body">
	
		@include('banco/gridBanco')
	
	</div>
	
</div>
	
@stop