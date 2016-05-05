<nav class="navbar navbar-default">

	<div class="container-fluid">
	
		<div class="navbar-header">
			<a class="navbar-brand" href="{{ url('/home') }}">Inicio</a>
		</div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

			<ul class="nav navbar-nav navbar-left">

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Cadastros<span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="{{ url('/bancos') }}">Bancos</a></li>
						<li><a href="{{ url('/categorias') }}">Categorias</a></li>
						<li><a href="{{ url('/clientes') }}">Clientes</a></li>
						<li><a href="{{ url('/fornecedores') }}">Fornecedores</a></li>
						<li><a href="{{ url('/produtos') }}">Produtos</a></li>
						<li><a href="{{ url('/usuarios') }}">Usuários</a></li>
					</ul>
				</li>
				
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Caixa<span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="{{ url('/caixas') }}">Abrir/Fechar</a></li>
						<li><a href="{{ url('/movimentosCaixa') }}">Movimento de Caixa</a></li>
						<li><a href="{{ url('/vendas') }}">Vendas</a></li>
					</ul>
				</li>				
				
			</ul>
					
			<ul class="nav navbar-nav navbar-right">

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="{{ url('/logout') }}">Sair</a></li>
					</ul>
				</li>
				
			</ul>
			
		</div>
		
	</div>
	
</nav>