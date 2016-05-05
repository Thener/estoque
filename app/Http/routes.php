<?php

//---- GRIDS:
Route::post('/grid/produtos', 'ProdutoController@grid');
Route::post('/grid/bancos', 'BancoController@grid');
Route::post('/grid/clientes', 'ClienteController@grid');
Route::post('/grid/fornecedores', 'FornecedorController@grid');
Route::post('/grid/caixas', 'CaixaController@grid');
Route::post('/grid/movimentosCaixa', 'MovimentoCaixaController@grid');
Route::post('/grid/usuarios', 'UsuarioController@grid');

//---- AUTO-COMPLETE:
Route::get('/autocomplete/nomeProduto', 'ProdutoController@autoCompleteNomeProduto');
Route::get('/autocomplete/nomeCliente', 'ClienteController@autoCompleteNomeCliente');
Route::get('/autocomplete/nomeFornecedor', 'FornecedorController@autoCompleteNomeFornecedor');

//---- LOGIN:
Route::get('/', 'LoginController@login');
Route::get('/login', 'LoginController@login');
Route::post('/login', 'LoginController@logar');
Route::get('/logout', 'LoginController@logout');

//---- PRODUTO:
Route::get('/produtos', 'ProdutoController@pesquisarProduto');
Route::get('/visualizarProduto/{id}', 'ProdutoController@visualizarProduto');
Route::get('/incluirProduto/', 'ProdutoController@incluirProduto');
Route::get('/alterarProduto/{id}', 'ProdutoController@alterarProduto');
Route::get('/excluirProduto/{id}', 'ProdutoController@excluirProduto');
Route::post('/gravarProduto/', 'ProdutoController@gravarProduto');
Route::get('/recuperarProdutoPorId/{id}', 'ProdutoController@recuperarProdutoPorId');

//---- CLIENTE:
Route::get('/clientes', 'ClienteController@pesquisarCliente');
Route::get('/visualizarCliente/{id}', 'ClienteController@visualizarCliente');
Route::get('/incluirCliente/', 'ClienteController@incluirCliente');
Route::get('/alterarCliente/{id}', 'ClienteController@alterarCliente');
Route::get('/excluirCliente/{id}', 'ClienteController@excluirCliente');
Route::post('/gravarCliente/', 'ClienteController@gravarCliente');
Route::get('/recuperarClienteJsonPorCpf/{cpf}', 'ClienteController@recuperarClienteJsonPorCpf');

//---- FORNECEDOR:
Route::get('/fornecedores', 'FornecedorController@pesquisarFornecedor');
Route::get('/visualizarFornecedor/{id}', 'FornecedorController@visualizarFornecedor');
Route::get('/incluirFornecedor/', 'FornecedorController@incluirFornecedor');
Route::get('/alterarFornecedor/{id}', 'FornecedorController@alterarFornecedor');
Route::get('/excluirFornecedor/{id}', 'FornecedorController@excluirFornecedor');
Route::post('/gravarFornecedor/', 'FornecedorController@gravarFornecedor');

//---- BANCO:
Route::get('/bancos', 'BancoController@pesquisarBanco');
Route::get('/visualizarBanco/{id}', 'BancoController@visualizarBanco');
Route::get('/incluirBanco/', 'BancoController@incluirBanco');
Route::get('/alterarBanco/{id}', 'BancoController@alterarBanco');
Route::get('/excluirBanco/{id}', 'BancoController@excluirBanco');
Route::post('/gravarBanco/', 'BancoController@gravarBanco');

//---- CAIXA:
Route::get('/caixas', 'CaixaController@pesquisarCaixa');
Route::get('/visualizarCaixa/{id}', 'CaixaController@visualizarCaixa');
Route::get('/abrirCaixa/', 'CaixaController@abrirCaixa');
Route::get('/fecharCaixa/{id}', 'CaixaController@fecharCaixa');
Route::post('/efetuarFechamentoCaixa/', 'CaixaController@efetuarFechamentoCaixa');
Route::get('/alterarCaixa/{id}', 'CaixaController@alterarCaixa');
Route::get('/excluirCaixa/{id}', 'CaixaController@excluirCaixa');
Route::post('/gravarCaixa/', 'CaixaController@gravarCaixa');

//---- MOVIMENTO DE CAIXA:
Route::get('/movimentosCaixa', 'MovimentoCaixaController@pesquisarMovimentoCaixa');
Route::get('/visualizarMovimentoCaixa/{id}', 'MovimentoCaixaController@visualizarMovimentoCaixa');
Route::get('/incluirMovimentoCaixa/', 'MovimentoCaixaController@incluirMovimentoCaixa');
Route::get('/alterarMovimentoCaixa/{id}', 'MovimentoCaixaController@alterarMovimentoCaixa');
Route::get('/excluirMovimentoCaixa/{id}', 'MovimentoCaixaController@excluirMovimentoCaixa');
Route::post('/gravarMovimentoCaixa/', 'MovimentoCaixaController@gravarMovimentoCaixa');

//---- VENDA:
Route::get('/vendas', 'VendaController@vender');
Route::post('/incluirProdutoVenda', 'VendaController@incluirProdutoVenda');
Route::get('/listarProdutosVenda', 'VendaController@listarProdutosVenda');
Route::get('/excluirProdutoVenda/{key}', 'VendaController@excluirProdutoVenda');
Route::get('/atualizarProdutoVenda/{key}/{quantidade}', 'VendaController@atualizarProdutoVenda');
Route::get('/excluirTodosProdutosVenda', 'VendaController@excluirTodosProdutosVenda');
Route::get('/incluirValorDescontoVenda/{valorDesconto?}', 'VendaController@incluirValorDescontoVenda');
Route::get('/incluirPercentualDescontoVenda/{percentualDesconto?}', 'VendaController@incluirPercentualDescontoVenda');
Route::get('/finalizarVendaDinheiro', 'VendaController@finalizarVendaDinheiro');
Route::get('/finalizarVendaCartao', 'VendaController@finalizarVendaCartao');
Route::get('/finalizarVendaCrediario/{idCliente}', 'VendaController@finalizarVendaCrediario');
Route::get('/informacoesVenda', 'VendaController@informacoesVenda');
Route::post('/gravarClienteVenda', 'VendaController@gravarClienteVenda');
Route::post('/calcularParcelamentoVenda', 'VendaController@calcularParcelamento');

//---- USUÁRIO:
Route::get('/usuarios', 'UsuarioController@pesquisarUsuario');
Route::get('/visualizarUsuario/{id}', 'UsuarioController@visualizarUsuario');
Route::get('/incluirUsuario/', 'UsuarioController@incluirUsuario');
Route::get('/alterarUsuario/{id}', 'UsuarioController@alterarUsuario');
Route::get('/excluirUsuario/{id}', 'UsuarioController@excluirUsuario');
Route::post('/gravarUsuario/', 'UsuarioController@gravarUsuario');



