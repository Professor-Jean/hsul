<?php
$p_nome = $_POST["txtnome"];


if($p_nome==""){
$mensagem2 = mensagensadm(1, 'Nome');
}else{

  $enviar_diretorio      = "../adicionais/marcas_imagens/";
  $enviar_nome_arquivo   = criptografiaNomeImg($_FILES['flimage']['name']);
  $enviar_arquivo       = $enviar_diretorio.$enviar_nome_arquivo;

  $validacao_ext = array('image/jpeg', 'image/png');

  if(in_array($_FILES['flimage']['type'], $validacao_ext)){

    //move um arquivo que foi enviado para o servidor//
    if (move_uploaded_file($_FILES['flimage']['tmp_name'], $enviar_arquivo)){

      $hs_sel_marcas = "SELECT * FROM marcas WHERE nome='".$p_nome."'";

      $hs_sel_marcas_preparado = $conexaobd->prepare($hs_sel_marcas);

      $hs_sel_marcas_preparado->execute();

      if($hs_sel_marcas_preparado->rowCount()==0){

        $tabela = "marcas";

        $dados = array(
          'nome'        => $p_nome,
          'imagem'      => $enviar_nome_arquivo
        );

        $hs_ins_marcas_resultado = adicionar($tabela, $dados);

      if($hs_ins_marcas_resultado){
        $mensagem2 = mensagensadm(3);
      }else{
        $mensagem2 = mensagensadm(8, 'marca', 'essa');
        unlink($enviar_arquivo);
      }
    }else{
      $mensagem2 = mensagensadm(7, 'Marca');
    }
  }
}
}
    ?>
<section>
  <div class="mensagem">
    <h3><i class="fa fa-exclamation-circle" aria-hidden="true"></i></i>Aviso</h3>
    <p><?php echo $mensagem2;?></p>
    <a href="?pasta=marcas/&arq=hs_fmins_marcas&ext=php">Voltar</a>
  </div>
</section>
