<fieldset>

	<legend>Pagamento em dinheiro:</legend>

	<div class="form-group maskmoney" style="float: left;">
		<label>R$ Recebido</label>
		<input id="recebido" class="form-control maskMoney" />
	</div>
	
	<div class="form-group maskmoney" style="float: left; padding-left:10px;">
		<label>R$ Troco</label>
		<input id="troco" class="form-control" readonly/>
	</div>	
	
	<div style="float: left; padding:25px 11px;">
		<button class="btn btn-primary" 
			onclick="javascript:window.location.href='/finalizarVendaDinheiro'"	type="button">
			Finalizar venda com dinheiro
		</button>
	</div>
	
</fieldset>

<script>

	$('#recebido').change(function(){

		var recebido = moedaDesformatar($('#recebido').val());
		var totalPagar = moedaDesformatar($('#totalPagar').val());
		var troco = recebido - totalPagar;

		$('#troco').val( moedaFormatar(troco) );		

	});

</script>