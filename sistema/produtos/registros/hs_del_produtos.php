<h1> Aviso </h1>
  <?php
  $p_id = $_POST['id'];

  if($p_id==""){
    $mensagem2 = mensagensadm(9, 'Produto');
  }else{

    $hs_sel_produtos = "SELECT * FROM entradasestoque WHERE MD5(produtos_id)='".$p_id."'";

    $hs_sel_produtos_preparado = $conexaobd->prepare($hs_sel_produtos);

    $hs_sel_produtos_preparado->execute();

      if($hs_sel_produtos_preparado->rowCount() > 0){

        $mensagem2 = mensagensadm(13, 'entradas de estoque');

      }else{

      $tabela = "produtos";

      $condicao = "MD5(id)='".$p_id."'";

      $hs_del_produtos_resultado = deletar($tabela, $condicao);

      if($hs_del_produtos_resultado){
  			$mensagem2 = mensagensadm(10, 'produto', 'de');
      }else{
        $mensagem2 = mensagensadm(11, 'produto', 'de');
      }
    }
  }
    ?>
    <section>
      <div class="mensagem">
        <h3><i class="fa fa-exclamation-circle" aria-hidden="true"></i></i>Aviso</h3>
        <p><?php echo $mensagem2;?></p>
        <a href="?pasta=produtos/registros/&arq=hs_fmins_produtos&ext=php">Voltar</a>
      </div>
    </section>
