<div style="border: 1px dashed #337ab7; margin-bottom: 10px; padding: 5px 11px 0px; clear: both;">
	<label style="color: #337ab7">1) Número de Parcelas:</label>
</div>

<form id="formCalculoParcelamento">
	
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
	
	<div class="form-group" style="float: left;">
		<label>Parcelas</label>
		<input name="qtdeParcelas" id="quantidade" value="1" maxlength="3" class="form-control calculoTotalItem limparAposIncluirProduto"
			onKeyPress="return SomenteNumero(event)" />
	</div>	
	
	<div class="form-group maskdate" style="float: left; padding-left: 10px;">
		<label>Venc 1a. Parcela</label>
    	<div class="input-group date showCalendar">
			<input name="vencParc1" type="text" class="form-control maskdate">
			<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
    	</div>	
    </div>	
    
	<div style="float: left; padding:25px 60px;">
		<button class="btn btn-success" onclick="javascript:calcularParcelamento()" type="button">Calcular</button>
		<script>
			function calcularParcelamento() {
				$.ajax({
                   	type: "POST",
                   	url : "/calcularParcelamentoVenda",
                   	data : $('#formCalculoParcelamento').serialize(),
			       	beforeSend : function() {
			       		$('#formCalculoParcelamento').css('opacity','0.6');
			       	},		                    	
                   	success : function(view){
                   		$('#formCalculoParcelamento').css('opacity','1');
                   		$('#calcParcelamento').html(view);
                   	}
				});
			}
		</script>		
	</div>    

</form>

<div id="calcParcelamento"></div>