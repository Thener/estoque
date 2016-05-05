@extends('layout/default')

@section('conteudo')

<div class="panel panel-primary">

	<div class="panel-heading">Venda</div>
	
	<div class="panel-body">
	
		<form id="formIncluirProdutoVenda" method="post">

			<fieldset>
				<legend>Selecione os Produtos:</legend>
				
				<div class="form-group" style="float: left;">
					<label>Código</label>
					<input name="produto_id" id="idProduto" class="form-control limparAposIncluirProduto" />					
				</div>

				<div class="form-group" style="float: left; padding-left:10px;">
					<label>Nome</label>
					<input name="produto_nome"  id="nomeProduto" class="form-control calculoTotalItem limparAposIncluirProduto" />
					<script>
						$('#nomeProduto').autocomplete({
						    serviceUrl: '/autocomplete/nomeProduto',						    
						    onSelect: function (suggestion) {
						        $('#idProduto').val(suggestion.data.id);
						        $('#precoVenda').val(suggestion.data.preco_venda);
						        calcularTotalItem();
						    },
						    minChars: 3
						});
					</script>					
				</div>
				
				<div class="form-group" style="float: left; padding-left:10px;">
					<label>Quantidade</label>
					<input name="quantidade" id="quantidade" value="1" class="form-control calculoTotalItem limparAposIncluirProduto"
						onKeyPress="return SomenteNumero(event)" maxlength="3" />
				</div>	
				
				<div class="form-group maskmoney" style="float: left; padding-left:10px;">
					<label>R$ Unitário</label>
					<input name="preco_venda" id="precoVenda" class="form-control maskMoney calculoTotalItem limparAposIncluirProduto" />
				</div>
				
				<div class="form-group maskmoney" style="float: left; padding-left:10px;">
					<label>R$ Item</label>
					<input name="total_item" id="totalItem" class="form-control limparAposIncluirProduto" readonly/>
				</div>				
				
				<div style="float: left; padding:25px 11px;">
					<button class="btn btn-primary" onclick="javascript:incluirProdutoVenda()" type="button">Incluir</button>
					<script>
						function incluirProdutoVenda() {
							$.ajax({
		                    	type: "POST",
		                    	url : "/incluirProdutoVenda",
		                    	data : $('#formIncluirProdutoVenda').serialize(),
					        	beforeSend : function() {
					        		//$('#listaProdutos').css('opacity','0.4');
					        	},		                    	
		                    	success : function(){
		                 			//$('#listaProdutos').html(lista).css('opacity','1');
		                 			manipularLista("/listarProdutosVenda");
		                 			$('.limparAposIncluirProduto').val('');
		                 			$('#quantidade').val('1');
		                 			$('#idProduto').focus();
		                    	}
							});
						}
					</script>
				</div>
				
				<div id="listaProdutos" style="clear:both;">
				
				</div>
				
			</fieldset>
			
		</form>
		
		<fieldset id="fsFormaPagamento" style="display: none;">
			<legend>Pagamento:</legend>
			
			<div class="form-group">
				<label>Forma</label>
				{!! Form::select('tipo_venda', $tiposVenda, null, array('id' => 'tipoVenda', 'class' => 'form-control')) !!}
			</div>
			
			<div id="venda_DIN" class="formasPagamento" style="display:none;">
				@include('venda/vendaDinheiro')
			</div>
			
			<div id="venda_CAR" class="formasPagamento" style="display:none;">
				@include('venda/vendaCartao')
			</div>
			
			<div id="venda_CRE" class="formasPagamento" style="display:none;">
				@include('venda/vendaCrediario')
			</div>			
			
		</fieldset>
	
	</div>
	
</div>
	
<script>

	function calcularTotalItem() {
		
		var qtde = $('#quantidade').val();
		var preco = moedaDesformatar($('#precoVenda').val());
		var item = qtde * preco;

		$('#totalItem').val( moedaFormatar(item) );
	}

	$('.calculoTotalItem').change(function(){
		calcularTotalItem();
	});

	manipularLista("/listarProdutosVenda");
	
	function manipularLista(url) {

		$.ajax({
        	type: "GET",
        	url : url,
        	async: false,
        	beforeSend : function() {
        		$('#listaProdutos').css('opacity','0.4');
        	}, 	                    	
        	success : function(lista){
     			$('#listaProdutos').html(lista).css('opacity','1');
     			ocultarMostrarFormaPagamento();
        	}
		});
	}

	function ocultarMostrarFormaPagamento() {

		$.ajax({
        	type: "GET",
        	url : "/informacoesVenda",
        	dataType: 'json',
        	success : function(info){
     			if (info.qtde_itens > 0) {
					$('#fsFormaPagamento').show();
     			} else {
     				$('#fsFormaPagamento').hide();
     			}
        	}
		});
	}

	$('#idProduto').change(function(){

		var id = $(this).val();
		
		$.ajax({
        	type: "GET",
        	url : '/recuperarProdutoPorId/' + id,
        	beforeSend : function() {
        		$('#nomeProduto').css('opacity','0.4');
        	}, 	                    	
        	success : function(produto){
     			$('#nomeProduto').val(produto.nome).css('opacity','1');
     			$('#precoVenda').val(produto.preco_venda);
     			calcularTotalItem();
        	}
		});
	});	

	$('#tipoVenda').change(function(){

		var tipo = $(this).val();

		$('.formasPagamento').hide();

		$('#venda_' + tipo).fadeIn();

	});
		
</script>
	
@stop