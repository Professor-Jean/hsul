<h1> Aviso </h1>
  <?php
  $p_id = $_POST['id'];


  if($p_id==""){
    $mensagem2 = mensagensadm(9, 'Marca');
  }else{

    $hs_sel_marcas = "SELECT * FROM produtos WHERE MD5(marcas_id)='".$p_id."'";

    $hs_sel_marcas_preparado = $conexaobd->prepare($hs_sel_marcas);

    $hs_sel_marcas_preparado->execute();


      if($hs_sel_marcas_preparado->rowCount() > 0){

        $mensagem2 = mensagensadm(13, 'produto');

      }else{

        $tabela = "marcas";

        $condicao = "MD5(id)='".$p_id."'";

        $hs_del_marcas_resultado = deletar($tabela, $condicao);

        if($hs_del_marcas_resultado){
    			$mensagem2 = mensagensadm(10, 'marca', 'de');
        }else{
          $mensagem2 = mensagensadm(11, 'marca', 'de');
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
