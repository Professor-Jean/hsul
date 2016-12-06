<?php
  $p_id = $_POST['id']; //recebendo dados pela URL pelo modo GET, da pagina fmins

  if($p_id==""){
    $msg = mensagensadm(9, 'categoria');
  }else{

    $tabela = "categorias";
    $condicao = "MD5(id)='".$p_id."'";

    $hs_del_categorias_resultado = deletar($tabela, $condicao);

  if($hs_del_categorias_resultado){
    $msg = mensagensadm(10, 'categorias', 'de');

  }else{
    $msg = mensagensadm(12, 'categoria', 'Essa');
  }
}
?>
<section>
  <div class="mensagem">
    <h3><i class="fa fa-exclamation-circle" aria-hidden="true"></i></i>Aviso</h3>
    <p><?php echo $msg; ?></p>
    <a href="?pasta=categorias/&arq=hs_fmins_categorias&ext=php">Voltar</a>
  </div>
</section>
