<?php

$p_id = $_POST['hidid'];
$p_nome = $_POST['txtnome'];

 if($p_nome==""){
    $msg = mensagensadm(1, "'Nome do Estado'");
	$saida = "?pasta=localidades/estados/&arq=hs_fmupd_estados&ext=php&id=".$p_id."";
  }else{

      $hs_sel_estados = "SELECT * FROM estados WHERE nome='".$p_nome."'";
      $hs_sel_estados_preparado = $conexaobd->prepare($hs_sel_estados);
      $hs_sel_estados_preparado->execute();
      $hs_sel_estados_dados = $hs_sel_estados_preparado->fetch();

      if($hs_sel_estados_preparado->rowCount()==0){

        $tabela = "estados";

        $dados = array(
          'nome'        => $p_nome,
        );

        $condicao = "id= '".$p_id."'";
        $hs_upd_estados_resultado = alterar($tabela, $dados, $condicao);

        if($hs_upd_estados_resultado){
          $msg = mensagensadm(6,'estado', 'de');
		  $saida = "?pasta=localidades/estados/&arq=hs_fmins_estados&ext=php";		  
        }else{
          $msg = mensagensadm(2, 'estado');
		  $saida = "?pasta=localidades/estados/&arq=hs_fmupd_estados&ext=php&id=".$p_id."";
        }
      }else{
         $msg = mensagensadm(7, 'estado', 'Esse');
		 $saida = "?pasta=localidades/estados/&arq=hs_fmupd_estados&ext=php&id=".$p_id."";
      }
    }
?>

<section>
  <div class="mensagem">
    <h3><i class="fa fa-exclamation-circle" aria-hidden="true"></i></i>Aviso</h3>
    <p><?php echo $msg;?></p>
    <a href="<?php echo $saida; ?>">Voltar</a>
  </div>
</section>
