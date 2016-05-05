<div style="border: 1px dashed #337ab7; margin-bottom: 10px; padding: 5px 11px 0px; clear: both;">
	<label style="color: #337ab7">2) Pesquisar Cliente:</label>
</div>

<div class="form-group maskcpf" style="float: left;">
	<label>CPF</label>
   	<div class="input-group">
		<input id="cpfClientePesquisa" type="text" class="form-control maskcpf">
		<span class="input-group-addon" id="spanPesquisarCpf"><i class="glyphicon glyphicon-search"></i></span>
   	</div>
</div>
   
<div class="form-group" style="float: left; padding-left: 60px">
	<label>Nome</label>
	<input id="nomeClientePesquisa" class="form-control" style="width: 400px;" />
	<script>
		$('#nomeClientePesquisa').autocomplete({
		    serviceUrl: '/autocomplete/nomeCliente',						    
		    onSelect: function (suggestion) {
		        preencherCadastro(suggestion.data);
		        $('#cpfClientePesquisa').val('');
		    },
		    minChars: 3
		});
	</script>					
</div> 

<div style="clear: both;"></div>

<hr />

<form id="formCadastroCliente">
	
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
    
	<div class="form-group" style="float:left; width: 80px;">
		<label>Código</label>
		<input name="id" id="idCliente" class="form-control fieldCadastroCliente" readonly/>
	</div>    
    
	<div class="form-group" style="float:left; padding-left: 10px;">
		<label>Nome</label>
		<input name="nome" id="nomeCliente" maxlength="100" class="form-control clienteNome fieldCadastroCliente" />
	</div>
	
	<div class="form-group" style="float:left; padding-left: 10px;">
		<label>CPF</label>
		<input name="cpf" id="cpfCliente" maxlength="100" class="form-control maskcpf fieldCadastroCliente" />
	</div>	
	
	<div class="form-group" style="float:left; padding-left: 10px;">
		<label>Data Nascimento</label>
		<input name="data_nascimento" id="dataNascimentoCliente" class="form-control maskdate fieldCadastroCliente" />
	</div>
	
	<div class="form-group" style="float:left; padding-left: 10px;">
		<label>Telefone Fixo</label>
		<input name="telefone_fixo" id="telFixoCliente" maxlength="20" class="form-control fieldCadastroCliente telefone" />
	</div>
	
	<div class="form-group" style="float:left; padding-left: 10px;">
		<label>Telefone Celular</label>
		<input name="telefone_celular" id="telCelularCliente" maxlength="20" class="form-control fieldCadastroCliente telefone" />
	</div>
	
	<div class="form-group" style="float:left; padding-left: 10px;">
		<label>E-mail</label>
		<input name="email" id="emailCliente" maxlength="100" class="form-control email fieldCadastroCliente" />
	</div>
	
	<div class="form-group" style="float:left; padding-left: 10px;">
		<label>Logradouro</label>
		<input name="end_logradouro" id="endLogradouro" maxlength="100" class="form-control fieldCadastroCliente endLogradouro" />
	</div>
	
	<div class="form-group" style="float:left; padding-left: 10px;">
		<label>Número</label>
		<input name="end_numero"  id="endNumero" maxlength="20" class="form-control fieldCadastroCliente endNumero" />
	</div>
	
	<div class="form-group" style="float:left; padding-left: 10px;">
		<label>Complemento</label>
		<input name="end_complemento"  id="endComplemento" maxlength="20" class="form-control fieldCadastroCliente endComplemento" />
	</div>
	
	<div class="form-group" style="float:left; padding-left: 10px;">
		<label>Bairro</label>
		<input name="end_bairro"  id="endBairro" maxlength="50" class="form-control fieldCadastroCliente" />
	</div>
	
	<div class="form-group" style="float:left; padding-left: 10px;">
		<label>Cidade</label>
		<input name="end_cidade"  id="endCidade" maxlength="50" value="Juiz de Fora" class="form-control fieldCadastroCliente" />
	</div>		
	
	<div class="form-group" style="float:left; padding-left: 10px;">
		<label>UF</label>
		<input name="end_uf"  id="endUf" maxlength="2" value="MG" class="form-control fieldCadastroCliente uf" />
	</div>
	
	<div class="form-group" style="float:left; padding-left: 10px;">
		<label>Cep</label>
		<input name="end_cep"  id="endCep" class="form-control maskcep fieldCadastroCliente" />
	</div>
	
	<div style="float: left; padding:25px 11px;">
		<button class="btn btn-primary" onclick="javascript:gravarCliente()" type="button">Gravar</button>
		<script>
			function gravarCliente() {
				$.ajax({
                   	type: "POST",
                   	dataType: 'json',
                   	url : "/gravarClienteVenda",
                   	data : $('#formCadastroCliente').serialize(),
			       	beforeSend : function() {
			       		$('#formCadastroCliente').css('opacity','0.6');
			       	},		                    	
                   	success : function(info){
                   		$('#formCadastroCliente').css('opacity','1');
                   		if (info.sucesso) {
                   			$('#idCliente').val(info.clienteId);
                   		} else {
							alert(info.mensagem);
                   		}
                   	}
				});
			}
		</script>
	</div>
	
	<div style="float: left; padding:25px 2px;">
		<button class="btn btn-success" onclick="javascript:limparFormCadastroCliente()" type="button">Limpar Formulário</button>
	</div>		

</form>

<script>

	$('#spanPesquisarCpf').click(function(){

		var cpf = $('#cpfClientePesquisa').val();
		
		$.ajax({
			type: "GET",
			url : "/recuperarClienteJsonPorCpf/" + cpf,
			dataType: 'json',
			success : function(cliente) {
				if (!cliente) {
					limparFormCadastroCliente();
				} else {
					preencherCadastro(cliente);
				}
			}
		});		

	});

	function preencherCadastro(cliente) {

		$('#idCliente').val(cliente.id);
		$('#nomeCliente').val(cliente.nome);
		$('#cpfCliente').val(cliente.cpf);
		$('#dataNascimentoCliente').val(cliente.data_nascimento);
		$('#telFixoCliente').val(cliente.telefone_fixo);
		$('#telCelularCliente').val(cliente.telefone_celular);
		$('#emailCliente').val(cliente.email);
		$('#endLogradouro').val(cliente.end_logradouro);
		$('#endNumero').val(cliente.end_numero);
		$('#endComplemento').val(cliente.end_complemento);
		$('#endBairro').val(cliente.end_bairro);
		$('#endCidade').val(cliente.end_cidade);
		$('#endUf').val(cliente.end_uf);
		$('#endCep').val(cliente.end_cep);
	}

	function limparFormCadastroCliente() {

		$('.fieldCadastroCliente').val('');
		$('#endCidade').val('Juiz de Fora');
		$('#endUf').val('MG');		
	}
	
</script>