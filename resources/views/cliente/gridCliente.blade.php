<script src="{{ asset('/grid/flexigrid.pack.js') }}"></script>

<table id="gridClientes" class="flexigrid" style="display: none"></table>

<script type="text/javascript">
    $("#gridClientes").flexigrid({
        url: '/grid/clientes',
        dataType: 'json',
        colModel : [
            {display: 'Código', 		name : 'id', 	 			width : 80, sortable : true, align: 'left', hide: true},
            {display: 'Nome',      		name : 'nome', 				width : 300, sortable : true, align: 'left'}
        ],
        buttons : [
       		{name: 'Incluir', bclass: 'add', onpress : actionGridClientes},
       		{name: 'Alterar', bclass: 'edit', onpress : actionGridClientes},
       		{name: 'Excluir', bclass: 'delete', onpress : actionGridClientes},
       		{separator: true}
      	], 	        
        searchitems : [
            {display: 'Nome', name : 'nome', isdefault: true}
        ],
        sortname: "nome",
        sortorder: "asc",
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

    $('#gridClientes').dblclick( function(){
        var id = $('.trSelected').find('td[abbr="id"]').text();
        if(id != '')
            $(location).attr('href','/visualizarCliente/' + id);
    });	

    function actionGridClientes(com, grid) {
		var id = $('.trSelected', grid).find('td[abbr="id"]').text();
        var nome = $('.trSelected', grid).find('td[abbr="nome"]').text();
        switch(com) {
			case "Incluir":
                $(location).attr('href','/incluirCliente');
                break;
            case "Alterar":
                if (id != '') {
					$(location).attr('href','/alterarCliente/' + id);
                } else {
                    alert('Selecione um registro primeiro!');
                }
                break;	                
            case "Excluir":
                if (id != '') {
                    if(confirm('Deseja realmente excluir?\n' + nome))
                        $(location).attr('href','/excluirCliente/' + id);
                } else {
                    alert('Selecione um registro primeiro!');
                }
                break;
		}
	}	        

</script>