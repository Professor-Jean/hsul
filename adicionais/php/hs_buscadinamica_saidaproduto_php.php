<?php
  include "../../seguranca/banco_de_dados/hs_conexao_bd.php";

  $categoria_id = $_POST['id_categoria'];
  $marca_id     = $_POST['id_marca'];

  if ($categoria_id==""){
    echo "<option value=''>Selecione categoria</option>";
  }else if($marca_id==""){
        echo "<option value=''>Selecione marca</option>";
  }else{
    $hs_sel_produtos = "SELECT produtos.id, produtos.nome, produtos.produtos_diversos FROM produtos INNER JOIN entradasestoque ON entradasestoque.produtos_id=produtos.id WHERE categorias_id='".$categoria_id."' AND marcas_id='".$marca_id."'";
    $hs_sel_produtos_preparado = $conexaobd->prepare($hs_sel_produtos);
    $hs_sel_produtos_preparado->execute();

    if($hs_sel_produtos_preparado->rowCount()>0){
      echo "<option value=''>Escolha...</option>";
      while ($hs_sel_produtos_dados = $hs_sel_produtos_preparado->fetch()) {
        echo "<option value='".$hs_sel_produtos_dados['id']."'>".$hs_sel_produtos_dados['nome']."</option>";
      }
    }else{
      echo "<option value=''>---</option>";
    }
  }
?>
