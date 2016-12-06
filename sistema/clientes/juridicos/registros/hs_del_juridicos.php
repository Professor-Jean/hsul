<?php
  $p_juridicos_id = $_POST['id']; //recebendo dados pela URL pelo modo GET, da pagina fmins
  $p_clientes_id = $_POST['id2']; //recebendo dados pela URL pelo modo GET, da pagina fmins

    $hs_sel_juridicos = "SELECT clientesjuridicos.id AS id_juridicos, clientes.id AS id_clientes FROM clientesjuridicos INNER JOIN clientes ON clientesjuridicos.clientes_id=clientes.id WHERE MD5(clientesjuridicos.id)='".$p_juridicos_id."'";
    $hs_sel_juridicos_preparado = $conexaobd->prepare($hs_sel_juridicos);
    $hs_sel_juridicos_preparado->execute();
    $hs_sel_juridicos_dados = $hs_sel_juridicos_preparado->fetch();

  if($p_juridicos_id==""){
      $msg = mensagensadm(9, 'Cliente');
    }else if($p_clientes_id==""){
        $msg = mensagensadm(9, 'Cliente');
      }else{

        $hs_sel_orcamentos = "SELECT clientes.id AS clientes_id, orcamentos.clientes_id FROM orcamentos INNER JOIN clientes ON orcamentos.clientes_id=clientes.id WHERE MD5(clientes.id)='".$p_clientes_id."'";
        $hs_sel_orcamentos_preparado = $conexaobd->prepare($hs_sel_orcamentos);
        $hs_sel_orcamentos_preparado->execute();
        $hs_sel_orcamentos_dados = $hs_sel_orcamentos_preparado->fetch();

        if($hs_sel_orcamentos_preparado->rowCount()>0){
          $msg = mensagensadm(13, 'Orçamentos');
        }else{
        $tabela = "clientesjuridicos";
        $condicao = "MD5(id)='".$p_juridicos_id."'";

        $hs_del_juridicos_resultado = deletar($tabela, $condicao);

      if($hs_del_juridicos_resultado){
        $tabela = "clientes";
        $condicao = "MD5(id)='".$p_clientes_id."'";

        $hs_del_clientes_resultado = deletar($tabela, $condicao);

        if($hs_del_clientes_resultado){
            $msg = mensagensadm(10, 'cliente jurídico', 'de');
          }else{
              $msg = mensagensadm(11, 'cliente jurídico', 'de');
        }
        }else{
          $msg = mensagensadm(12, 'cliente juridico', 'Esse');
        }
      }
    }
?>
<section>
  <div class="mensagem">
    <h3><i class="fa fa-exclamation-circle" aria-hidden="true"></i></i>Aviso</h3>
    <p><?php echo $msg; ?></p>
    <a href="?pasta=clientes/juridicos/registros/&arq=hs_fmins_juridicos&ext=php">Voltar</a>
  </div>
</section>
