@extends('layout/logout')

@section('conteudo')

	<div style="width:30%; margin-left: 35%; margin-top: 10%">
	
		<div class="panel panel-primary">
		
			<div class="panel-heading">Login</div>
			
			<div class="panel-body">

				<form action="/login" method="post">
				
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				
					<div class="form-group">
						<label>Email</label>
						<input name="email" class="form-control" />
					</div>
				
					<div class="form-group">
						<label>Senha</label>
						<input name="password" type="password" class="form-control" />
					</div>
					
					<button class="btn btn-primary" type="submit">Login</button>
					
					@if (Session::get('message') != '')
						<div class="alert alert-danger" style="margin-top: 10px;">
							<ul>
								<li>{{ Session::get('message') }}</li>
							</ul>
						</div>
					@endif
					
				</form>

			</div>
			
		</div>
		
	</div>

@stop