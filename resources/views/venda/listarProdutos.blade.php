<table id="tableProdutos" class="table table-condensed table-hover">
	<thead>
		<tr style="background-color: #E6E6E6">
			<th>
				<a class="glyphicon glyphicon-trash" href="#" onclick="javascript: excluirTodosProdutosVenda();" />
			</th>
			<th>Código</th>
			<th>Nome</th>
			<th>Quantidade</th>
			<th style="text-align: right;">R$ Unitário</th>
			<th style="text-align: right; width: 180px;">R$ Item</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($produtos as $key => $produto)
			<tr id="trProdutoIncluido_{{ $key }}" >
				<td>
					<a class="glyphicon glyphicon-trash" href="#" onclick="javascript: excluirProdutoVenda( {{ $key }} );" />
				</td>
				<td>{{ $produto['id'] }}</td>
				<td>{{ $produto['nome'] }}</td>
				<td width="50px">
					<input value="{{ $produto['quantidade'] }}" class="form-control input-sm qtdeListaProduto qtde"
						onKeyPress="return SomenteNumero(event)" key="{{ $key }}" />
				</td>
				<td style="text-align: right;">{{ $produto['preco_venda'] }}</td>
				<td style="text-align: right;">{{ $produto['total_item'] }}</td>
			</tr>
		@endforeach
		<tr>
			<td colspan="4" align="right">
				<input value="{{ $qtde_total }}" class="form-control input-sm qtde" readonly/>
			</td>
			<td style="text-align: right;">R$ Sub-Total</td>
			<td align="right">
				<input value="{{ $total_venda }}" class="form-control input-sm vlrItem" readonly/>
			</td>
		</tr>
		
		<tr>
			<td colspan="5" style="text-align: right;">R$ Desconto</td>
			<td align="right">
				<input value="{{ $valor_desconto }}" name="valor_desconto_venda" 
					id="valorDescontoVenda" class="form-control maskMoney vlrItem" />
			</td>			
		</tr>
		
		<tr>
			<td colspan="5" style="text-align: right;">% Desconto</td>
			<td align="right">
				<input value="{{ $percentual_desconto }}" name="percentual_desconto_venda"  id="percentualDescontoVenda" 
					maxlength="6" class="form-control maskPercentual vlrItem" />
			</td>			
		</tr>
		
		<tr>
			<td colspan="5" style="text-align: right; font-size:20px;">Total a Pagar</td>
			<td align="right">
				<input value="{{ $total_pagar }}" id="totalPagar" style="font-size:20px;" 
					class="form-control input-sm vlrItem" readonly/>
			</td>			
		</tr>
	</tbody>
</table>

<script src="{{ asset('/maskMoney/jquery.maskMoney.min.js') }}"></script>
<script src="{{ asset('/maskMoney/maskMoney.js') }}"></script>

<script>

	function excluirProdutoVenda(key) {
		manipularLista("/excluirProdutoVenda/" + key);
	}

	function excluirTodosProdutosVenda() {
		if (confirm('Excluir todos os produtos selecionados?')) {
			manipularLista("/excluirTodosProdutosVenda/");
		}
	}
	
	$('.qtdeListaProduto').change(function(){
	
		var quantidade = $(this).val();
		var key = $(this).attr('key');
	
		manipularLista("/atualizarProdutoVenda/" + key + '/' + quantidade);
	
	});	

	$('#valorDescontoVenda').change(function(){
		
		var valorDesconto = $(this).val();
	
		manipularLista("/incluirValorDescontoVenda/" + valorDesconto);
	
	});

	$('#percentualDescontoVenda').change(function(){
		
		var percentualDesconto = $(this).val();
	
		manipularLista("/incluirPercentualDescontoVenda/" + percentualDesconto);
	
	});

</script>