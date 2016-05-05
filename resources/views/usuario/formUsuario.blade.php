@extends('layout/default')

@section('conteudo')

<div class="panel panel-primary">

	<div class="panel-heading">Cadastro de Usuário</div>
	
	<div class="panel-body">

		<form action="/gravarUsuario" method="post">
		
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			
			<input type="hidden" name="id" value="{{ $usuario->id }}" />
		
			<div class="form-group">
				<label>Nome</label>
				<input name="name" value="{{ $usuario->name }}" class="form-control" />
			</div>

			<div class="form-group">
				<label>Email</label>
				<input name="email" value="{{ $usuario->email }}" class="form-control" />
			</div>
			
			<div class="form-group">
				<label>Perfil</label>
				{!! Form::select('perfil', $perfis, @$usuario->perfil, array('class' => 'form-control')) !!}
			</div>			
			
			@if (!$somenteLeitura)
				<table>
					<tr>
					<td>
						<div class="form-group">
							<label>{{ isset($usuario->id) ? 'Nova Senha' : 'Senha'  }}</label>
							<input type="password" name="senha" value="{{ $usuario->senha }}" class="form-control" />
						</div>
					</td>
					<td>
						<div class="form-group" style="padding-left: 10px;">
							<label>Confirmação</label>
							<input type="password" name="confirmaSenha" value="{{ $usuario->confirmaSenha }}" class="form-control" />
						</div>				
					</td>
					</tr>
					@if (isset($usuario->id))
						<tr>
							<td colspan="2">
								<div class="alert alert-info well-sm" role="alert">
									Informe os campos "Nova Senha" e "Confirmação" apenas quando quiser redefinir a senha do usuário.
								</div>
							</td>
						</tr>
					@endif
				</table>
			@endif
			
			<a class="btn btn-primary" href="/usuarios" role="button">Sair</a>
			
			@if (!$somenteLeitura)
				<button class="btn btn-primary" type="submit">Gravar</button>		
			@endif
		</form>  
  
	</div>
	
</div>

@stop