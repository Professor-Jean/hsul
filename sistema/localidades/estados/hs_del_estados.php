<?php
  $p_id = $_POST['id']; //recebendo dados pela URL pelo modo GET, da pagina fmins

  if($p_id==""){
    $msg = mensagensadm(9, 'Estados');
  }else{

    $tabela = "estados";
    $condicao = "MD5(id)='".$p_id."'";

    $hs_del_cidades_resultado = deletar($tabela, $condicao);

  if($hs_del_cidades_resultado){
    $msg = mensagensadm(10, 'estado', 'de');

  }else{
    $msg = mensagensadm(12, 'estado', 'Esse');
  }
}
?>
<section>
  <div class="mensagem">
    <h3><i class="fa fa-exclamation-circle" aria-hidden="true"></i></i>Aviso</h3>
    <p><?php echo $msg; ?></p>
    <a href="?pasta=localidades/estados/&arq=hs_fmins_estados&ext=php">Voltar</a>
  </div>
</section>
