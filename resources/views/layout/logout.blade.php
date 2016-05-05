<html>

	<head>
		<link rel="stylesheet" type="text/css" href="/css/app.css">
		<title>Controle de Estoque</title>
		<script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('/js/jquery-2.1.4.min.js') }}"></script>
		<script>
			$(document).ready(function (){
				$('form:not(.filter) :input:visible:first').focus();
			});	
		</script>
		<style type="text/css">
			body {
				background-color: #E6E6E6 !important;
			}
		</style>				
	</head>
	
	<body>
		
		@yield('conteudo')
		
	</body>

</html>