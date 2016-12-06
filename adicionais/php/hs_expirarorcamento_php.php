<?php
  //include "../../seguranca/banco_de_dados/hs_conexao_bd.php";

//  function validadeorcamento(){
//    $data_hoje = date("Y-m-d");
//    $hs_sel_orcamentos = "SELECT id, comentario FROM orcamentos WHERE status='0' AND data_validade<='".$data_hoje."'";
//    $hs_sel_orcamentos_preparado = $conexaobd->prepare($hs_sel_orcamentos);
//    $hs_sel_orcamentos_preparado->execute();

//    echo $hs_sel_orcamentos;

//    if($hs_sel_orcamentos_preparado->rowCount()>0){
//      while($hs_sel_orcamentos_dados = $hs_sel_orcamentos_preparado->fetch()){

//        $tabela = "orcamentos";

//        $dados = array(
//          'motivo'      => 'NR',
//          'status'      => 3,
//          'comentario'  => $hs_sel_orcamentos_dados['comentario']
//        );

//        $condicao = "id='".$p_id."'";

//        $hs_upd_orcamentos_resultado = alterar($tabela, $dados, $condicao);
//        }
//      }
//  }
?>
