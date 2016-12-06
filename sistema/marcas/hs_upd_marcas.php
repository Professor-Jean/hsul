<?php
//Recebendo valores dos campos do formulário//
$p_id = $_POST['hidid'];
$p_nome = $_POST["txtnome"];
$caminho = "?pasta=marcas/&arq=hs_fmupd_marcas&ext=php&id=".$p_id;

if($p_nome==""){
$mensagem2 = mensagensadm(1, 'Nome');
}else{

  $hs_sel_marcas = "SELECT * FROM marcas WHERE nome='".$p_nome."' AND id<>'".$p_id."'";

  $hs_sel_marcas_preparado = $conexaobd->prepare($hs_sel_marcas);

  if (($_FILES['flimage']['name'])==""){

        if($hs_sel_marcas_preparado->rowCount()==0){

          $tabela = "marcas";

          $dados = array(
            'nome'        => $p_nome
          );

          $condicao = "id= '".$p_id."'";
          $hs_upd_marcas_resultado = alterar($tabela, $dados, $condicao);

          if($hs_upd_marcas_resultado){
            $mensagem2 = mensagensadm(6,'marca', 'de');
            $caminho = "?pasta=marcas/&arq=hs_fmins_marcas&ext=php";
          }else{
            $mensagem2 = mensagensadm(2, 'marca');
          }
        }else{
           $mensagem2 = mensagensadm(7, 'marca', 'Essa');
         }
      }else{
        $enviar_diretorio      = "../adicionais/marcas_imagens/";

        $enviar_nome_arquivo   = criptografiaNomeImg($_FILES['flimage']['name']);

        $enviar_arquivo       = $enviar_diretorio.$enviar_nome_arquivo;

        $validacao_ext = array('image/jpeg', 'image/png');

        if(in_array($_FILES['flimage']['type'], $validacao_ext)){
          //move um arquivo que foi enviado para o servidor//
          if (move_uploaded_file($_FILES['flimage']['tmp_name'], $enviar_arquivo)){

            if($hs_sel_marcas_preparado->rowCount()==0){

              $tabela = "marcas";

              $dados = array(
                'nome'        => $p_nome,
                'imagem'      => $enviar_nome_arquivo
              );

              $condicao = "id= '".$p_id."'";
              $hs_upd_marcas_resultado = alterar($tabela, $dados, $condicao);

              if($hs_upd_marcas_resultado){
                $mensagem2 = mensagensadm(6,'marca', 'de');
                $caminho = "?pasta=marcas/&arq=hs_fmins_marcas&ext=php";
              }else{
                $mensagem2 = mensagensadm(2, 'marca');
              }
            }else{
               $mensagem2 = mensagensadm(7, 'marca', 'Essa');
               unlink($enviar_arquivo);
            }
          }
        }
      }
    }
      ?>
      <section>
        <div class="mensagem">
          <h3><i class="fa fa-exclamation-circle" aria-hidden="true"></i></i>Aviso</h3>
          <p><?php echo $mensagem2;?></p>
          <a href="<?php echo $caminho;?>">Voltar</a>
        </div>
      </section>
