<?php
include "../../seguranca/banco_de_dados/hs_conexao_bd.php";

$idProduto = $_POST['idp'];
$qtdProduto = $_POST['idq'];

$idProduto = json_decode($idProduto);
$qtdProduto = json_decode($qtdProduto);

$qtdTotal = count($idProduto);
$total = 0;

for($i=0; $i<$qtdTotal; $i++){
  $sql_sel_produtos = "SELECT produtos.id AS produtoid, entradasestoque.id, entradasestoque.quantidade AS quantidade, entradasestoque.valor_compra AS valor_compra, categorias.id, categorias.lucro_bruto AS lucro FROM produtos INNER JOIN entradasestoque ON entradasestoque.produtos_id=produtos.id INNER JOIN categorias ON produtos.categorias_id=categorias.id WHERE produtos.id='".$idProduto[$i]."'";
  $sql_sel_produtos_preparado = $conexaobd->prepare($sql_sel_produtos);
  $sql_sel_produtos_preparado->execute();
  $sql_sel_produtos_dados = $sql_sel_produtos_preparado->fetch();

  $valor_compra = $sql_sel_produtos_dados['valor_compra'];
  $lucro = $sql_sel_produtos_dados['lucro'];

  $lucro_emcima = $valor_compra * $lucro / 100;
  $valor_total = $valor_compra + $lucro_emcima;

  $total += $valor_total*$qtdProduto[$i];
}

echo $total;

?>
