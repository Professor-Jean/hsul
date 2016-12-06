<span class="imprimir">
<h2>Relatório de Saída de Estoque</h2>
</span>
<form action="../adicionais/php/hs_construirpdf_php.php" id="gearpdf" method="POST" onsubmit="return catchContent()">
    <input type="hidden" name="dadospdf" id="dadospdf" value="">
    <button type="submit" id="pdf">Gerar PDF</button>
</form>

<?php
  $hs_sel_saida = "SELECT produtos.nome AS produtos_nome, categorias.nome AS categorias, categorias.lucro_bruto, marcas.nome AS marcas, saidasestoque.quantidade AS quantidade, saidasestoque.data_saida, saidasestoque.observacoes, entradasestoque.valor_compra FROM saidasestoque INNER JOIN estoques ON saidasestoque.estoques_id=estoques.id INNER JOIN produtos ON estoques.produtos_id=produtos.id INNER JOIN entradasestoque ON entradasestoque.produtos_id=produtos.id INNER JOIN categorias ON produtos.categorias_id=categorias.id INNER JOIN marcas ON produtos.marcas_id=marcas.id";
  $hs_sel_saida_preparado = $conexaobd->prepare($hs_sel_saida);
  $hs_sel_saida_preparado->execute();
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
        <th>Valor de venda</th>
        <th>Data de saída</th>
        <th>Observações</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if($hs_sel_saida_preparado->rowCount()>0){
          while($hs_sel_saida_dados = $hs_sel_saida_preparado->fetch()){
            $data = explode("-", $hs_sel_saida_dados['data_saida']);
            $data = explode("-", $hs_sel_saida_dados['data_saida']);//Divide uma string em strings//
            $valorvenda = ($hs_sel_saida_dados['lucro_bruto']/100)*$hs_sel_saida_dados['valor_compra'];
      ?>
      <tr>
        <td><?php echo $hs_sel_saida_dados['produtos_nome']; ?></td>
        <td><?php echo $hs_sel_saida_dados['categorias']; ?></td>
        <td><?php echo $hs_sel_saida_dados['marcas']; ?></td>
        <td><?php echo $hs_sel_saida_dados['quantidade']; ?></td>
        <td><?php echo number_format($valorvenda,2,',',''); ?></td>
        <td><?php echo $data['2']."/".$data['1']."/".$data['0']; ?></td>
        <td><?php echo $hs_sel_saida_dados['observacoes'];?></td>
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
