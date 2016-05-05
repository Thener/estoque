@extends('layout/default')

@section('conteudo')

<div class="panel panel-primary">

	<div class="panel-heading">Usuários</div>
	
	<div class="panel-body">
	
		@include('usuario/gridUsuario')
	
	</div>
	
</div>
	
@stop