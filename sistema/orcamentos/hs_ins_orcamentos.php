<?php

$p_funcionario = $_SESSION['idUsuario'];
$p_cliente = $_POST['selclientes'];
$p_bairro = $_POST['txtbairro'];
$p_logradouro = $_POST['txtlogradouro'];
$p_estado = $_POST['selestado'];
$p_cidade = $_POST['selcidade'];
$p_cep = $_POST['txtcep'];
$p_numeroresidencia = $_POST['txtnumeroresidencia'];
$p_complemento = $_POST['txtcomplemento'];
$p_data_validade = $_POST['txtdatadevalidade'];
$data = explode("/", $p_data_validade);
$p_valor_mao_de_obra = $_POST['txtmaodeobra'];
$p_desconto = $_POST['txtdesconto'];
$p_comentario = $_POST['txtcomentario'];

$p_categorias = $_POST['selcategorias'];
$p_marca = $_POST['selmarcas'];
$p_produto = $_POST['selprodutos'];
$p_quantidade = $_POST['txtquantidade'];

// conta quantos "detalhes" foram preenchidos
$q_selcategoria = count($p_categorias);

$p_categoria_validacao = true;
$p_marca_validacao = true;
$p_produto_validacao = true;
$p_quantidade_validacao = true;

//cria uma repetição para validar os dados
for($contadora=0; $contadora<$q_selcategoria; $contadora++){
	//se, no array recebido, a posição atual da contadora estiver vazia
	if($p_categorias[$contadora]==""){
		// altera o valor da variável criada anteriormente, dizendo que não está preenchido corretamente!
		$p_categoria_validacao =  false;
		//sai da repetição
		break;
	}
	if($p_marca[$contadora]==""){
		// altera o valor da variável criada anteriormente, dizendo que não está preenchido corretamente!
		$p_marca_validacao =  false;
		//sai da repetição
		break;
	}
	if($p_produto[$contadora]==""){
		$p_produto_validacao =  false; // aqui diz que não está preenchido corretamente!
		break;
	}
	if($p_quantidade[$contadora]==""){
		$p_quantidade_validacao =  false; // aqui diz que não está preenchido corretamente!
		break;
	}
}

$p_categorias_diversos = $_POST['selcategoriasp'];
$p_marca_diversos = $_POST['selmarcasp'];
$p_produto_diversos = $_POST['selprodutosp'];
$p_quantidade_diversos = $_POST['txtquantindadep'];

// conta quantos "detalhes" foram preenchidos
$q_categoria_diversos = count($p_categorias_diversos);

$p_categoriadiversos_validacao = true;
$p_marcadiversos_validacao = true;
$p_produtodiversos_validacao = true;
$p_quantidadediversos_validacao = true;

//cria uma repetição para validar os dados
for($contadora2=0; $contadora2<$q_categoria_diversos; $contadora2++){
	//se, no array recebido, a posição atual da contadora estiver vazia
	if($p_categorias_diversos[$contadora2]==""){
		// altera o valor da variável criada anteriormente, dizendo que não está preenchido corretamente!
		$p_categoriadiversos_validacao =  false;
		//sai da repetição
		break;
	}
	if($p_marca_diversos[$contadora2]==""){
		// altera o valor da variável criada anteriormente, dizendo que não está preenchido corretamente!
		$p_marcadiversos_validacao =  false;
		//sai da repetição
		break;
	}
	if($p_produto_diversos[$contadora2]==""){
		$p_produtodiversos_validacao =  false; // aqui diz que não está preenchido corretamente!
		break;
	}
	if($p_quantidade_diversos[$contadora2]==""){
		$p_quantidadediversos_validacao =  false; // aqui diz que não está preenchido corretamente!
		break;
	}
}


if($p_cliente==""){
  $msg = mensagensadm(1, "'Nome do Cliente'");
}else if((!$p_categoria_validacao)){
    $msg = "Para registrar é necessario escolher um produto, e prencher corretamente os dados dele!";
  }else if(($p_categoria_validacao)&&(!$p_marca_validacao)){
	    $msg = "Alguma 'Marca' não foi selecionada em produtos!";
		}else if(($p_categoria_validacao)&&(!$p_produto_validacao)){
				$msg = "Algum 'Nome do produto' não foi selecionado em produtos!";
	  	}else if(($p_categoria_validacao)&&(!$p_quantidade_validacao)){
	  	  	$msg = "Alguma 'Quantidade' não foi preenchida em produtos!";
				}else if(($p_categoriadiversos_validacao)&&(!$p_marcadiversos_validacao)){
		  			$msg = "Alguma 'Marca' não foi selecionada em produtos diversos!";
					}else if(($p_categoriadiversos_validacao)&&(!$p_produtodiversos_validacao)){
							$msg = "Algum 'Nome do produto' não foi selecionado em produtos diversos!";
		  			}else if(($p_categoriadiversos_validacao)&&(!$p_quantidadediversos_validacao)){
			  				$msg = "Alguma 'Quantidade' não foi preenchida em produtos diversos!";
							}else if($p_valor_mao_de_obra==""){
			    				$msg = mensagensadm(1, "'Valor da mão de obra'");
								}else if ($p_desconto==""){
									  $msg = mensagensadm(1, "'Desconto'");
									}else if($p_data_validade==""){
											$msg = mensagensadm(1, "'Data de validade'");
									  }else if($p_cep==""){
										  	$msg = mensagensadm(1, "'CEP'");
											}else if($p_estado==""){
													$msg = mensagensadm(1, "'Estado'");
										  	}else if($p_cidade==""){
											  		$msg = mensagensadm(1, "'Cidade'");
													}else if($p_bairro==""){
															$msg = mensagensadm(1, "'Bairro'");
											  		}else if($p_logradouro==""){
												  			$msg = mensagensadm(1, "'Logradouro'");
															}else if($p_numeroresidencia==""){
																	$msg = mensagensadm(1, "'Numero da residência'");
												  			}else if($p_complemento==""){
													  				$msg = mensagensadm(1, "'Complemento'");
																	}else{

																		$mao_de_obra = explode(',', $p_valor_mao_de_obra);
																		$desconto = explode(',', $p_desconto);

																	  $tabela = "orcamentos";
																	  $dados = array(
																	    'clientes_id'        => $p_cliente,
																	    'funcionarios_id'    => $p_funcionario,
																	    'cidades_id'         => $p_cidade,
																	    'cep'                => $p_cep,
																	    'bairro'             => $p_bairro,
																	    'logradouro'         => $p_logradouro,
																			'numero_residencia'  => $p_numeroresidencia,
																	    'complemento'        => $p_complemento,
																	    'data_validade'      => $data[2]."-".$data[1]."-".$data[0],
																	    'status'             => '0',
																	    'valor_mao_de_obra'  => $p_valor_mao_de_obra,
																	    'desconto'           => $p_desconto,
																	    'descricao'         => $p_comentario
																	  );

																	$hs_ins_orcamentos_resultado = adicionar($tabela, $dados);

																	$id_anterior = $conexaobd->lastInsertId();

																	if($hs_ins_orcamentos_resultado){

																		if(($p_categoria_validacao)&&($p_categoriadiversos_validacao)){
																			//inserir produtos
																			for($contadora=0; $contadora<$q_selcategoria; $contadora++){

																			  $hs_sel_produtosestoque = "SELECT categorias.lucro_bruto, entradasestoque.valor_compra, entradasestoque.produtos_id FROM entradasestoque INNER JOIN produtos ON entradasestoque.produtos_id=produtos.id INNER JOIN categorias ON produtos.categorias_id=categorias.id WHERE produtos_id='".$p_produto[$contadora]."'";
																			  $hs_sel_produtosestoque_preparado = $conexaobd->prepare($hs_sel_produtosestoque);
																			  $hs_sel_produtosestoque_preparado->execute();
																			  $hs_sel_produtosestoque_dados = $hs_sel_produtosestoque_preparado->fetch();

																				$valor_por_produto = $hs_sel_produtosestoque_dados['valor_compra'];
																				$margem = $hs_sel_produtosestoque_dados['lucro_bruto'];
																				$lucro_produto = ($valor_por_produto * $margem) / 100;
																				$valor_final = $valor_por_produto + $lucro_produto;

																				$tabela = "orcamentos_has_produtos";
																				$dados = array(
																				  'orcamentos_id'          => $id_anterior,
																				  'produtos_id'            => $p_produto[$contadora],
																				  'quantidade_por_produto' => $p_quantidade[$contadora],
																				  'valor_por_produto'      => $valor_final
																				);
																				$hs_ins_orcamentos_produtos_resultado = adicionar($tabela, $dados);
																			}

																			if($hs_ins_orcamentos_produtos_resultado){

																				//inserir produtos diversos
																				for($contadora2=0; $contadora2<$q_categoria_diversos; $contadora2++){

																				  $hs_sel_produtosestoque2 = "SELECT categorias.lucro_bruto, entradasestoque.valor_compra, entradasestoque.produtos_id FROM entradasestoque INNER JOIN produtos ON entradasestoque.produtos_id=produtos.id INNER JOIN categorias ON produtos.categorias_id=categorias.id WHERE produtos_id='".$p_produto_diversos[$contadora2]."'";
																				  $hs_sel_produtosestoque_preparado2 = $conexaobd->prepare($hs_sel_produtosestoque2);
																				  $hs_sel_produtosestoque_preparado2->execute();
																				  $hs_sel_produtosestoque_dados2 = $hs_sel_produtosestoque_preparado2->fetch();

																					$valor_por_produto2 = $hs_sel_produtosestoque_dados2['valor_compra'];
																					$margem2 = $hs_sel_produtosestoque_dados2['lucro_bruto'];
																					$lucro_produto2 = ($valor_por_produto2 * $margem2) / 100;
																					$valor_final2 = $valor_por_produto2 + $lucro_produto2;

																				  $tabela = "orcamentos_has_produtos";
																				  $dados = array(
																					'orcamentos_id'          => $id_anterior,
																					'produtos_id'            => $p_produto_diversos[$contadora2],
																					'quantidade_por_produto' => $p_quantidade_diversos[$contadora2],
																					'valor_por_produto'      => $valor_final2
																				  );

																				  $hs_ins_orcamentos_produtos_resultado2 = adicionar($tabela, $dados);
																				}

																				if($hs_ins_orcamentos_produtos_resultado2){
																					$msg = mensagensadm(3);
																			    }else{
																				  $tabela = "orcamentos_has_produtos";
																				  $condicao = "orcamentos_id='".$id_anterior."'";
																				  $hs_del_orcamentos_produtos_resultado = deletar($tabela, $condicao);

																				  $tabela = "orcamentos";
																				  $condicao = "id='".$id_anterior."'";
																				  $hs_del_orcamentos_resultado = deletar($tabela, $condicao);

																				  $msg = "Ocorreu um erro ao inserir os produtos diversos, que foram selecionados no orçamento";
																				}
																			}else{
																			  $tabela = "orcamentos";
																			  $condicao = "id='".$id_anterior."'";
																			  $hs_del_orcamentos_resultado = deletar($tabela, $condicao);

																			  $msg = "Ocorreu um erro ao inserir os produtos, que foram seleciondos no orçamento";
																			}

																		}else{

																			//inserir produto
																			for($contadora=0; $contadora<$q_selcategoria; $contadora++){

																				$hs_sel_produtosestoque = "SELECT categorias.lucro_bruto, entradasestoque.valor_compra, entradasestoque.produtos_id FROM entradasestoque INNER JOIN produtos ON entradasestoque.produtos_id=produtos.id INNER JOIN categorias ON produtos.categorias_id=categorias.id WHERE produtos_id='".$p_produto[$contadora]."'";
																			  $hs_sel_produtosestoque_preparado = $conexaobd->prepare($hs_sel_produtosestoque);
																			  $hs_sel_produtosestoque_preparado->execute();
																			  $hs_sel_produtosestoque_dados = $hs_sel_produtosestoque_preparado->fetch();

																				$valor_por_produto = $hs_sel_produtosestoque_dados['valor_compra'];
																				$margem = $hs_sel_produtosestoque_dados['lucro_bruto'];
																				$lucro_produto = ($valor_por_produto * $margem) / 100;
																				$valor_final = $valor_por_produto + $lucro_produto;


																				$tabela = "orcamentos_has_produtos";
																				$dados = array(
																					'orcamentos_id'          => $id_anterior,
																					'produtos_id'            => $p_produto[$contadora],
																					'quantidade_por_produto' => $p_quantidade[$contadora],
																					'valor_por_produto'      => $valor_final
																				);
																				$hs_ins_orcamentos_produtos_resultado = adicionar($tabela, $dados);
																			}

																			if($hs_ins_orcamentos_produtos_resultado){
																				$msg = mensagensadm(3);
																			}else{
																					$tabela = "orcamentos";
																					$condicao = "id='".$id_anterior."'";
																					$hs_del_orcamentos_resultado = deletar($tabela, $condicao);

																					$msg = "Ocorreu um erro ao inserir os produtos, que foram seleciondos no orçamento";
																				}
																			}
															}else{
																$msg = mensagensadm(8, 'orçamento', 'o');
															}
															}

  ?>
<section>
  <div class="mensagem">
    <h3><i class="fa fa-exclamation-circle" aria-hidden="true"></i></i>Aviso</h3>
    <p><?php echo $msg;?></p>
    <a href="?pasta=orcamentos/&arq=hs_fmins_orcamentos&ext=php">Voltar</a>
  </div>
</section>
