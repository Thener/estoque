@extends('layout/default')

@section('conteudo')

<div class="panel panel-primary">

	<div class="panel-heading">Caixa</div>
	
	<div class="panel-body">

		<form action="/gravarCaixa" method="post">
		
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			
			<div class="form-group">		
				<label>
					Aberto por: 
					<span style="font-weight: bold; color:blue;"> {{ Auth::user()->name }} </span>
				</label>
			</div>
			
			<div class="form-group maskmoney">
				<label>Saldo Inicial</label>
				<input name="saldo_inicial" class="form-control maskMoney" />
			</div>			
					
			<div class="form-group maskdate">
				<label>Data do Caixa</label>
		    	<div class="input-group date showCalendar">
					<input name="data_caixa" value="{{ $hoje }}" type="text" class="form-control maskdate">
					<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
		    	</div>	
		    </div>
		    
			<a class="btn btn-primary" href="/caixas" role="button">Sair</a>
			
			<button class="btn btn-primary" type="submit">Abrir Caixa</button>		    

		</form>  
  
	</div>
	
</div>
	
@stop