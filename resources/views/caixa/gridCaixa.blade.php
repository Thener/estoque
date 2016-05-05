<script src="{{ asset('/grid/flexigrid.pack.js') }}"></script>

<table id="gridCaixas" class="flexigrid" style="display: none"></table>

<script type="text/javascript">
    $("#gridCaixas").flexigrid({
        url: '/grid/caixas',
        dataType: 'json',
        colModel : [
            {display: 'Número', 		name : 'id', 				width : 80, sortable : true, align: 'left'},
            {display: 'Data Caixa',	 	name : 'data_caixa', 		width : 80, sortable : true, align: 'center'},
            {display: 'Aberto por', 	name : 'aberto_por', 		width : 150, sortable : true, align: 'left'},
            {display: 'Saldo Inicial', 	name : 'saldo_inicial', 	width : 90, sortable : true, align: 'left'},
            {display: 'Entradas', 		name : 'total_entradas', 	width : 90, sortable : true, align: 'left'},
            {display: 'Saidas', 		name : 'total_saidas', 		width : 90, sortable : true, align: 'left'},
            {display: 'Saldo Final', 	name : 'saldo_final', 		width : 90, sortable : true, align: 'left'},
            {display: 'Fechado em', 	name : 'data_fechamento', 	width : 90, sortable : true, align: 'left'},
            {display: 'Fechado por', 	name : 'fechado_por', 		width : 150, sortable : true, align: 'left'}
        ],
        buttons : [
       		{name: 'Abrir Caixa', bclass: 'add', onpress : actionGridCaixas},
       		{name: 'Alterar', bclass: 'edit', onpress : actionGridCaixas},
       		{name: 'Fechar Caixa', bclass: 'check', onpress : actionGridCaixas},
       		{name: 'Excluir', bclass: 'delete', onpress : actionGridCaixas},
       		{separator: true}
      	], 	        
        searchitems : [
            {display: 'Número do Caixa', name : 'id', isdefault: true}
        ],
        sortname: "id",
        sortorder: "desc",
        usepager: true,
        useRp: true,
        rp: 10,
        rpOptions: [10,15,20,25,40,100],
        title: false,
        checkFirstColumn: false,
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

    function actionGridCaixas(com, grid) {
		var id = $('.trSelected', grid).find('td[abbr="id"]').text();
        var data_caixa = $('.trSelected', grid).find('td[abbr="data_caixa"]').text();
        switch(com) {
			case "Abrir Caixa":
                $(location).attr('href','/abrirCaixa');
                break;
            case "Fechar Caixa":
                if (id != '') {
					$(location).attr('href','/fecharCaixa/' + id);
                } else {
                    alert('Selecione um registro primeiro!');
                }
                break;	                
            case "Alterar":
                if (id != '') {
					$(location).attr('href','/alterarCaixa/' + id);
                } else {
                    alert('Selecione um registro primeiro!');
                }
                break;	                
            case "Excluir":
                if (id != '') {
                    if(confirm('Deseja realmente excluir?\n' + data_caixa))
                        $(location).attr('href','/excluirCaixa/' + id);
                } else {
                    alert('Selecione um registro primeiro!');
                }
                break;
		}
	}	        

</script>