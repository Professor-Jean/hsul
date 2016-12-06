<span class="imprimir">
<h2>Relatório de Entrada de Estoque</h2>
</span>
<form action="../adicionais/php/hs_construirpdf_php.php" id="gearpdf" method="POST" onsubmit="return catchContent()">
    <input type="hidden" name="dadospdf" id="dadospdf" value="">
    <button type="submit" id="pdf">Gerar PDF</button>
</form>
<?php

$hs_sel_entrada = "SELECT produtos.id AS produtos_id, produtos.categorias_id, categorias.nome AS categorias, produtos.marcas_id, marcas.nome AS marcas, produtos.nome AS produto_nome, entradasestoque.quantidade, entradasestoque.valor_compra, entradasestoque.data_entrada, entradasestoque.observacoes FROM entradasestoque INNER JOIN produtos ON entradasestoque.produtos_id=produtos.id INNER JOIN categorias ON produtos.categorias_id=categorias.id INNER JOIN marcas ON produtos.marcas_id=marcas.id";

$hs_sel_entrada_preparado = $conexaobd->prepare($hs_sel_entrada);

$hs_sel_entrada_preparado->execute();

?>
<span class="imprimir">
<div class="consultas">
  <table>
    <thead>
      <tr>
        <th>Nome</th>
        <th>Categoria</th>
        <th>Marca</th>
        <th>Quantidade</th>
        <th>Valor de entrada</th>
        <th>Data de entrada</th>
        <th>Observações</th>
      </tr>
    </thead>
    <tbody>
      <?php

      if($hs_sel_entrada_preparado->rowCount()>0){
          while($hs_sel_entrada_dados = $hs_sel_entrada_preparado->fetch()){
            $data = explode("-", $hs_sel_entrada_dados['data_entrada']);
      ?>
      <tr>
        <td><?php echo $hs_sel_entrada_dados['produto_nome']; ?></td>
        <td><?php echo $hs_sel_entrada_dados['categorias']; ?></td>
        <td><?php echo $hs_sel_entrada_dados['marcas']; ?></td>
        <td><?php echo $hs_sel_entrada_dados['quantidade']; ?></td>
        <td><?php echo number_format($hs_sel_entrada_dados['valor_compra'],2,',',''); ?></td>
        <td><?php echo $data['2']."/".$data['1']."/".$data['0']; ?></td>
        <td><?php echo $hs_sel_entrada_dados['observacoes'];?></td>
      </tr>
      <?php
          }//fechando a estrutura de repeticao//
        }else{
      ?>
      <tr>
        <td align="center" colspan="9">Não há registros.</td>
      </tr>
      <?php
        }
      ?>
    </tbody>
  </table>
  </span>
</div>
