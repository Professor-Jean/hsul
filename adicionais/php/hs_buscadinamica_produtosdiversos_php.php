 <?php

 include "../../seguranca/banco_de_dados/hs_conexao_bd.php";

  $id_categoriap = $_POST['id_categoriap'];
  $id_marcap = $_POST['id_marcap'];

  if($id_categoriap==""){
    echo "<option value=''>Selecione categoria</option>";
  }else if($id_marcap==""){
        echo "<option value=''>Selecione marca</option>";
  }else{
    $hs_sel_produtos = "SELECT produtos.id, produtos.nome, produtos.produtos_diversos FROM produtos INNER JOIN entradasestoque ON entradasestoque.produtos_id=produtos.id WHERE categorias_id='$id_categoriap' AND marcas_id='$id_marcap' AND produtos_diversos='1' ORDER BY nome ASC";
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
