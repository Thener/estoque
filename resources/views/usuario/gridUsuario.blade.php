<script src="{{ asset('/grid/flexigrid.pack.js') }}"></script>

<table id="gridUsuarios" class="flexigrid" style="display: none"></table>

<script type="text/javascript">
    $("#gridUsuarios").flexigrid({
        url: '/grid/usuarios',
        dataType: 'json',
        colModel : [
            {display: 'Código', 	name : 'id', 	width : 80, sortable : true, align: 'left', hide: true},
            {display: 'Nome',      	name : 'name', 	width : 300, sortable : true, align: 'left'},
            {display: 'Email',      name : 'email', width : 300, sortable : true, align: 'left'},
            {display: 'Perfil',     name : 'perfil',width : 300, sortable : true, align: 'left'}
        ],
        buttons : [
       		{name: 'Incluir', bclass: 'add', onpress : actionGridUsuarios},
       		{name: 'Alterar', bclass: 'edit', onpress : actionGridUsuarios},
       		{name: 'Excluir', bclass: 'delete', onpress : actionGridUsuarios},
       		{separator: true}
      	], 	        
        searchitems : [
            {display: 'Nome', name : 'name', isdefault: true}
        ],
        sortname: "name",
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

    $('#gridUsuarios').dblclick( function(){
        var id = $('.trSelected').find('td[abbr="id"]').text();
        if(id != '')
            $(location).attr('href','/visualizarUsuario/' + id);
    });	

    function actionGridUsuarios(com, grid) {
		var id = $('.trSelected', grid).find('td[abbr="id"]').text();
        var nome = $('.trSelected', grid).find('td[abbr="name"]').text();
        switch(com) {
			case "Incluir":
                $(location).attr('href','/incluirUsuario');
                break;
            case "Alterar":
                if (id != '') {
					$(location).attr('href','/alterarUsuario/' + id);
                } else {
                    alert('Selecione um registro primeiro!');
                }
                break;	                
            case "Excluir":
                if (id != '') {
                    if(confirm('Deseja realmente excluir?\n' + nome))
                        $(location).attr('href','/excluirUsuario/' + id);
                } else {
                    alert('Selecione um registro primeiro!');
                }
                break;
		}
	}	        

</script>