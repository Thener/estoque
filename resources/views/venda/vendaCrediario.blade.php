<style>
	
</style>

<fieldset>
	<legend>Pagamento no Crediário:</legend>
	<table>
		<tr>
			<td width="30%" valign="top">
				@include('venda/parcelamento')
			</td>
			<td width="10px">
			</td>
			<td valign="top">
				@include('venda/cadastroCliente')
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<div style="border: 1px dashed #337ab7; margin-bottom: 10px; padding: 5px 11px 0px; clear: both;">
					<label style="color: #337ab7">3) Finalizar:</label>
				</div>
				<button class="btn btn-warning" 
					onclick="javascript:finalizarVendaCrediario();" type="button">
					Finalizar venda no crediário
				</button>				
			</td>
		</tr>
	</table>
</fieldset>

<script>

	function finalizarVendaCrediario() {

		if (!confirm('Confirma conclusão da venda a credíário?')) {
			return false;
		}
		
		var idCliente = $('#idCliente').val();
		
		window.location.href='/finalizarVendaCrediario/' + idCliente;
	}

</script>