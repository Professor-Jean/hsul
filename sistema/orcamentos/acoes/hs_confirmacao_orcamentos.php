<?php

 $p_id = $_POST['hidid'];
 $p_data = $_POST['txtdata'];
 $data = explode("/", $p_data);
 $p_comentario = $_POST['txtcomentario'];

  $hs_sel_orcamentos = "SELECT * FROM orcamentos WHERE id='".$p_id."'";
  $hs_sel_orcamentos_preparado = $conexaobd->prepare($hs_sel_orcamentos);
  $hs_sel_orcamentos_preparado->execute();
  $hs_sel_orcamentos_dados = $hs_sel_orcamentos_preparado->fetch();

   if($p_comentario==""){
	$p_comentario = NULL;
	}

$saida = "?pasta=orcamentos/acoes/&arq=hs_fmconfirmacao_orcamentos&ext=php&id='".$hs_sel_orcamentos_dados['id']."'";

 if($p_data==""){
    $msg = mensagensadm(1, "'Data de início'");
  }else{

        $tabela = "orcamentos";

        $dados = array(
          'clientes_id'        => $hs_sel_orcamentos_dados['clientes_id'],
          'funcionarios_id'    => $hs_sel_orcamentos_dados['funcionarios_id'],
          'cidades_id'         => $hs_sel_orcamentos_dados['cidades_id'],
          'bairro'             => $hs_sel_orcamentos_dados['bairro'],
          'logradouro'         => $hs_sel_orcamentos_dados['logradouro'],
          'data_validade'      => $hs_sel_orcamentos_dados['data_validade'],
          'status'        	   => '1',
          'valor_mao_de_obra'  => $hs_sel_orcamentos_dados['valor_mao_de_obra'],
          'desconto'           => $hs_sel_orcamentos_dados['desconto'],
          'descricao'          => $hs_sel_orcamentos_dados['descricao'],
          'data_inicio'        => $data['2']."-".$data['1']."-".$data['0'],
          'motivo'             => NULL,
          'comentario'         => $p_comentario,
          'data_conclusao'     => NULL,
          'cep'                => $hs_sel_orcamentos_dados['cep'],
          'complemento'        => $hs_sel_orcamentos_dados['complemento']
        );

        $condicao = "id= '".$p_id."'";
        $hs_upd_estados_resultado = alterar($tabela, $dados, $condicao);

        if($hs_upd_estados_resultado){
          $msg = mensagensadm(3);
		      $saida = "?pasta=orcamentos/acoes/&arq=hs_controle_orcamentos&ext=php";
        }else{
          $msg = mensagensadm(8, 'confirmação de orçamentos', '');
        }
    }
?>

<section>
  <div class="mensagem">
    <h3><i class="fa fa-exclamation-circle" aria-hidden="true"></i></i>Aviso</h3>
    <p><?php echo $msg;?></p>
    <a href="<?php echo $saida;?>">Voltar</a>
  </div>
</section>
