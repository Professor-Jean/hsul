<?php

$p_id = $_POST['hidid'];

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

$saidas = "?pasta=orcamentos/acoes/&arq=hs_fmupd_orcamentos&ext=php&id=".$p_id."";

if($p_cliente==""){
  $msg = mensagensadm(1, "'Nome do Cliente'");
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
						  $condicao = "id= '".$p_id."'";
						  $hs_upd_orcamentos_resultado = alterar($tabela, $dados, $condicao);

						if($hs_upd_orcamentos_resultado){
						    $msg = mensagensadm(6,'orcamentos', 'de');
							$saidas = "?pasta=orcamentos/acoes/&arq=hs_controle_orcamentos&ext=php";
						  }else{
							  $msg = mensagensadm(2, 'orçamento', 'o');
						  }
						}

  ?>
<section>
  <div class="mensagem">
    <h3><i class="fa fa-exclamation-circle" aria-hidden="true"></i></i>Aviso</h3>
    <p><?php echo $msg;?></p>
    <a href="<?php echo $saidas;?>">Voltar</a>
  </div>
</section>
