<?php
  $p_fisicos_id = $_POST['id']; //recebendo dados pela URL pelo modo GET, da pagina fmins
  $p_clientes_id = $_POST['id2']; //recebendo dados pela URL pelo modo GET, da pagina fmins

    $hs_sel_fisicos = "SELECT clientesfisicos.id AS id_fisicos, clientes.id AS id_clientes FROM clientesfisicos INNER JOIN clientes ON clientesfisicos.clientes_id=clientes.id WHERE MD5(clientesfisicos.id)='".$p_fisicos_id."'";
    $hs_sel_fisicos_preparado = $conexaobd->prepare($hs_sel_fisicos);
    $hs_sel_fisicos_preparado->execute();
    $hs_sel_fisicos_dados = $hs_sel_fisicos_preparado->fetch();

  if($p_fisicos_id==""){
      $msg = mensagensadm(9, 'Cliente');
    }else if($p_clientes_id==""){
        $msg = mensagensadm(9, 'Cliente');
      }else{
        $hs_sel_orcamentos = "SELECT clientes.id AS id_clientes, orcamentos.clientes_id FROM orcamentos INNER JOIN clientes ON orcamentos.clientes_id=clientes.id WHERE MD5(clientes.id)='".$p_clientes_id."'";
        $hs_sel_orcamentos_preparado = $conexaobd->prepare($hs_sel_orcamentos);
        $hs_sel_orcamentos_preparado->execute();
        $hs_sel_orcamentos_dados = $hs_sel_orcamentos_preparado->fetch();

        if($hs_sel_orcamentos_preparado->rowCount()>0){
          $msg = mensagensadm(13, 'Orçamentos');
        }else{
        $tabela = "clientesfisicos";
        $condicao = "MD5(id)='".$p_fisicos_id."'";

        $hs_del_fisicos_resultado = deletar($tabela, $condicao);

      if($hs_del_fisicos_resultado){
        $tabela = "clientes";
        $condicao = "MD5(id)='".$p_clientes_id."'";

        $hs_del_clientes_resultado = deletar($tabela, $condicao);

        if($hs_del_clientes_resultado){
            $msg = mensagensadm(10, 'cliente fisico', 'de');
          }else{
              $msg = mensagensadm(11, 'cliente fisico', 'de');
        }
        }else{
          $msg = mensagensadm(12, 'cliente fisico', 'Esse');
        }
      }
    }
?>
<section>
  <div class="mensagem">
    <h3><i class="fa fa-exclamation-circle" aria-hidden="true"></i></i>Aviso</h3>
    <p><?php echo $msg; ?></p>
    <a href="?pasta=clientes/fisicos/registros/&arq=hs_fmins_fisicos&ext=php">Voltar</a>
  </div>
</section>
