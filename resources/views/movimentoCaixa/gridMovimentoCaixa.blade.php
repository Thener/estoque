<script src="{{ asset('/grid/flexigrid.pack.js') }}"></script>

<table id="gridMovimentoCaixa" class="flexigrid" style="display: none"></table>

<script type="text/javascript">
    $("#gridMovimentoCaixa").flexigrid({
        url: '/grid/movimentosCaixa',
        dataType: 'json',
        colModel : [
            {display: 'Código', 		 name : 'id', 	 			width : 80, sortable : true, align: 'left', hide: true},
            {display: 'No. Caixa', 		 name : 'caixa_id', 	 	width : 80, sortable : true, align: 'left'},
            {display: 'Descrição',       name : 'descricao', 		width : 300, sortable : true, align: 'left'},
            {display: 'Entrada', 		 name : 'valor_movimento', 	width : 80, sortable : true, align: 'left'},
            {display: 'Saída', 		 	 name : 'valor_movimento', 	width : 80, sortable : true, align: 'left'}
        ],
        buttons : [
       		{name: 'Incluir', bclass: 'add', onpress : actionGridFluxoCaixa},
       		{name: 'Alterar', bclass: 'edit', onpress : actionGridFluxoCaixa},
       		{name: 'Excluir', bclass: 'delete', onpress : actionGridFluxoCaixa},
       		{separator: true}
      	], 	        
        searchitems : [
            {display: 'Descrição', name : 'descricao', isdefault: true}
        ],
        sortname: "caixa_id",
        sortorder: "desc",
        usepager: true,
        useRp: true,
        rp: 10,
        rpOptions: [10,15,20,25,40,100],
        title: false,
        width: '100%',
        height: 270,
        singleSelect: true,
        errormsg:'Erro de conexão',
        pagestat:'Exibindo de {from} a {to} de um total de {total} registros.',
        pagetext:'Página',
        outof:'de',
        findtext:'Busca',
        procmsg:'Processando, por favor aguarde ...',
        nomsg:'Nenhum item'
    });

    $('#gridMovimentoCaixa').dblclick( function(){
        var id = $('.trSelected').find('td[abbr="id"]').text();
        if(id != '')
            $(location).attr('href','/visualizarMovimentoCaixa/' + id);
    });	

    function actionGridFluxoCaixa(com, grid) {
		var id = $('.trSelected', grid).find('td[abbr="id"]').text();
        var nome = $('.trSelected', grid).find('td[abbr="descricao"]').text();
        switch(com) {
			case "Incluir":
                $(location).attr('href','/incluirMovimentoCaixa');
                break;
            case "Alterar":
                if (id != '') {
					$(location).attr('href','/alterarMovimentoCaixa/' + id);
                } else {
                    alert('Selecione um registro primeiro!');
                }
                break;	                
            case "Excluir":
                if (id != '') {
                    if(confirm('Deseja realmente excluir?\n' + nome))
                        $(location).attr('href','/excluirMovimentoCaixa/' + id);
                } else {
                    alert('Selecione um registro primeiro!');
                }
                break;
		}
	}	        

</script>