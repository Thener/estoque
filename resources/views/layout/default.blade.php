<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Controle de Estoque</title>
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/sistema.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/venda.css') }}" rel="stylesheet">
	<link href="{{ asset('/grid/flexigrid.css') }}" rel="stylesheet">
	<script src="{{ asset('/js/jquery-2.1.4.min.js') }}"></script>
	<script src="{{ asset('/js/util.js') }}"></script>
	<script src="{{ asset('/js/somente-numeros.js') }}"></script>
	<script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}"></script>
	<link href="{{ asset('/datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
	<script src="{{ asset('/datepicker/bootstrap-datepicker.min.js') }}"></script>
	<script src="{{ asset('/datepicker/bootstrap-datepicker.pt-BR.min.js') }}"></script>
	<script src="{{ asset('/datepicker/calendario.js') }}"></script>
	<script src="{{ asset('/maskMoney/jquery.maskMoney.min.js') }}"></script>
	<script src="{{ asset('/maskMoney/maskMoney.js') }}"></script>
	<script src="{{ asset('/maskInput/jquery.maskedinput.js') }}"></script>
	<script src="{{ asset('/maskInput/maskInput.js') }}"></script>
	<script src="{{ asset('/autocomplete/jquery.autocomplete.min.js') }}"></script>
	<link href="{{ asset('/autocomplete/autocomplete.css') }}" rel="stylesheet">
	
	<script>
		$(document).ready(function (){
			$('form:not(.filter) :input:visible:first').focus();

			$.ajaxSetup({
			    headers:{
			        'X-CSRF-TOKEN':'{!! csrf_token() !!}'
			    }
			});			
		});	
	</script>
	
</head>

<body>
	
	<div class="cabecalho">
		SCV :: Sistema de Controle de Vendas
	</div>
	
	@include('layout/menu')
	
	@include('layout/errors')
		
	<div class="conteudo">
		@yield('conteudo')
	</div>
	
</body>

</html>