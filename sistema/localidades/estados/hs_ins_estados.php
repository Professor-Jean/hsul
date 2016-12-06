<?php

  $p_estado = $_POST['txtnome'];

  if($p_estado==""){
      $msg = mensagensadm(1, "'Nome do Estado'");
    }else{

      $hs_sel_estados = "SELECT * FROM estados WHERE nome='".$p_estado."'";
      $hs_sel_estados_preparado = $conexaobd->prepare($hs_sel_estados);
      $hs_sel_estados_preparado->execute();

      if($hs_sel_estados_preparado->rowCount()==0){
        $tabela = "estados";
        $dados = array(
          'nome'       => $p_estado
        );

        $hs_ins_estados_resultado = adicionar($tabela, $dados);

        if($hs_ins_estados_resultado==true){
          $msg = mensagensadm(3);
        }

      }else{
        $msg = mensagensadm(7, "estado", "Esse");
      }
    }

?>
<section>
  <div class="mensagem">
    <h3><i class="fa fa-exclamation-circle" aria-hidden="true"></i></i>Aviso</h3>
    <p><?php echo $msg;?></p>
    <a href="?pasta=localidades/estados/&arq=hs_fmins_estados&ext=php">Voltar</a>
  </div>
</section>
