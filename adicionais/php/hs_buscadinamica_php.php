<?php
  include "../../seguranca/banco_de_dados/hs_conexao_bd.php";
  $estados_id = $_POST['id'];

  if ($estados_id==""){
    echo "<option value=''>Selecione estado</option>";
  }else{
    $hs_sel_cidades = "SELECT id, nome FROM cidades WHERE estados_id='".$estados_id."'";
    $hs_sel_cidades_preparado = $conexaobd->prepare($hs_sel_cidades);
    $hs_sel_cidades_preparado->execute();

    if($hs_sel_cidades_preparado->rowCount()>0){
      echo "<option value=''>Escolha...</option>";
      while ($hs_sel_cidades_dados = $hs_sel_cidades_preparado->fetch()) {
        echo "<option value='".$hs_sel_cidades_dados['id']."'>".$hs_sel_cidades_dados['nome']."</option>";
      }
    }else{
      echo "<option value=''>---</option>";
    }
  }
?>
