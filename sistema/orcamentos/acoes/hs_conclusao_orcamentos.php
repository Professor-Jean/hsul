<?php
  $p_id         = $_POST['hidid'];
  $p_conclusao  = $_POST['txtconclusao'];
  $p_comentario = $_POST['txacomentario'];
  $voltar = "?pasta=orcamentos/acoes/&arq=hs_fmconclusao_orcamentos&ext=php&id=".$p_id;

  if($p_conclusao==""){
    $msg = mensagensadm(1, 'Data de Conclusão');
  }else{
    $hs_sel_orcamentos = "SELECT id FROM orcamentos WHERE id='".$p_id."' AND status='1'";
    $hs_sel_orcamentos_preparado = $conexaobd->prepare($hs_sel_orcamentos);
    $hs_sel_orcamentos_preparado->execute();

    if($hs_sel_orcamentos_preparado->rowCount()>0){

      $data = explode("/", $p_conclusao);
      $data_conclusao = $data[2]."-".$data[1]."-".$data[0];

      $tabela = "orcamentos";

      $dados = array(
        'data_conclusao'  => $data_conclusao,
        'status'          => 2,
        'comentario'      => $p_comentario
      );

      $condicao = "id='".$p_id."'";

      $hs_upd_orcamentos_resultado = alterar($tabela, $dados, $condicao);

      if($hs_upd_orcamentos_resultado){
        $msg = mensagensadm(6, 'orçamento', 'de');
        $voltar = "?pasta=orcamentos/acoes/&arq=hs_controle_orcamentos&ext=php";
      }else{
        $msg = mensagensadm(2, 'orçamento');
      }
    }else{
      $msg = mensagensadm(9, 'orçamento');
    }
  }
?>

<section>
  <div class="mensagem">
    <h3><i class="fa fa-exclamation-circle" aria-hidden="true"></i></i>Aviso</h3>
    <p><?php echo $msg;?></p>
    <a href="<?php echo $voltar?>">Voltar</a>
  </div>
</section>
