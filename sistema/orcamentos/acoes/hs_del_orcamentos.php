<?php
  $p_id = $_POST['id'];

  if($p_id==""){
    $msg = mensagensadm(9, 'orçamento');
  }else{

    $tabela = "orcamentos_has_produtos";

    $condicao = "MD5(orcamentos_id)='".$p_id."'";

    $hs_del_orcamentosprodutos_resultado = deletar($tabela, $condicao);

    $tabela = "orcamentos";

    $condicao = "MD5(id)='".$p_id."'";

    $hs_del_orcamentos_resultado = deletar($tabela, $condicao);

    if($hs_del_orcamentos_resultado&&$hs_del_orcamentosprodutos_resultado){
      $msg = mensagensadm(10, 'orçamento', 'de');

    }else{
      $msg = mensagensadm(11, 'orçamento e/ou seus produtos registrados', 'do');
    }
  }
  ?>
  <section>
    <div class="mensagem">
      <h3><i class="fa fa-exclamation-circle" aria-hidden="true"></i></i>Aviso</h3>
      <p><?php echo $msg; ?></p>
      <a href="?pasta=orcamentos/&arq=hs_con_declinados_orcamentos&ext=php">Voltar</a>
    </div>
  </section>
