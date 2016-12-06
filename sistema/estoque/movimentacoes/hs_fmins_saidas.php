<h2>Movimentação de Saída de Estoque</h2>
<script>

function mostraProdutos(){

  id_categoria = $('#selcategoria').val();

  id_marca = $('#selmarca').val();


  $('#selprodutos_id').html("<option>Aguarde</option>");

  $.ajax({
    type: "post",
    url: "../adicionais/php/hs_buscadinamica_saidaproduto_php.php",
    data: {"id_marca":id_marca, "id_categoria":id_categoria},
  }).done(function(data){
    $('#selprodutos_id').html(data);
  });
}

</script>
  <div>
    <div class="observacao">
      <fieldset>
        <legend>Observação</legend>
        <table>
          <tbody>
            <tr>
              <td> Ao escolher um produto diverso, a quantidade é dada em pacotes. Pode-se definir as quantidades dentro das embalagens nas observações.</td>
            </tr>
          </tbody>
        </table>
      </fieldset>
    </div>
    <div class="registros">
    <form name="frmcadmsaida" method="POST" action="?pasta=estoque/movimentacoes/&arq=hs_ins_saidas&ext=php" onsubmit="return validarmovsaida()">
      <table>
        <tr>
          <td colspan="2" class="obg">Campos com (*) são obrigatórios.</td>
        </tr>
        <tr>
          <td>*Categoria do produto: </td>
          <td>
            <select name="selcategoria" id="selcategoria" onchange="mostraProdutos()">
              <option value="">Selecione...</option>
              <?php
                $hs_sel_categorias = "SELECT * FROM categorias ORDER BY nome ASC";
                $hs_sel_categorias_preparado = $conexaobd->prepare($hs_sel_categorias);
                $hs_sel_categorias_preparado->execute();

                while($hs_sel_categorias_dados = $hs_sel_categorias_preparado->fetch()){
                  $id_categorias = $hs_sel_categorias_dados['id'];
                  $nome_categorias = $hs_sel_categorias_dados['nome'];

                  echo "<option value='".$id_categorias."'>".$nome_categorias."</option>";
                }
                ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>*Marca do produto: </td>
          <td>
            <select name="selmarca" id="selmarca" onchange="mostraProdutos()">
              <option value="">Selecione...</option>
              <?php
                $hs_sel_marcas = "SELECT * FROM marcas ORDER BY nome ASC";
                $hs_sel_marcas_preparado = $conexaobd->prepare($hs_sel_marcas);
                $hs_sel_marcas_preparado->execute();

                while($hs_sel_marcas_dados = $hs_sel_marcas_preparado->fetch()){
                  $id_marcas = $hs_sel_marcas_dados['id'];
                  $nome_marcas = $hs_sel_marcas_dados['nome'];

                  echo "<option value='".$id_marcas."'>".$nome_marcas."</option>";
                }
                ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>*Nome do produto: </td>
          <td>
            <select name="selprodutos_id"  id="selprodutos_id">
                <option value="">Selecione...</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>*Quantidade: </td>
          <td><input type="text" name="txtquantidade" maxlenght="4"/></td>
        </tr>
        <tr>
          <td>*Data de saída: </td>
          <td><input type="text" name="txtdatasaida" readonly='readonly'id="datepicker"/></td>
        </tr>
        <tr>
          <td>Observações: </td>
          <td><textarea name="txaobservacao"></textarea></td>
        </tr>
        <tr align="center">
          <td>
            <button type="reset">Limpar</button>
          </td>
          <td>
            <button type="submit">Salvar</button>
          </td>
        </tr>
      </table>
    </div>
  </div>
  <br>
  <div class="consultas">
    <?php
      $hs_sel_estoque = "SELECT produtos.nome AS produtos_nome, categorias.nome AS categoria_nome, categorias.lucro_bruto, marcas.nome AS marca_nome, saidasestoque.quantidade AS quantidade, saidasestoque.data_saida, saidasestoque.observacoes, entradasestoque.valor_compra FROM saidasestoque INNER JOIN estoques ON saidasestoque.estoques_id=estoques.id INNER JOIN produtos ON estoques.produtos_id=produtos.id INNER JOIN entradasestoque ON entradasestoque.produtos_id=produtos.id INNER JOIN categorias ON produtos.categorias_id=categorias.id INNER JOIN marcas ON produtos.marcas_id=marcas.id";
      $hs_sel_estoque_preparado = $conexaobd->prepare($hs_sel_estoque);
      $hs_sel_estoque_preparado->execute();
    ?>
    <table>
      <thead>
        <tr>
          <th>Nome</th>
          <th>Categoria</th>
          <th>Marca</th>
          <th>Quantidade</th>
          <th>Valor de venda</th>
          <th>Data de saída</th>
          <th colspan="4" width="90px">Observações</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if($hs_sel_estoque_preparado->rowCount()>0){
            while($hs_sel_estoque_dados = $hs_sel_estoque_preparado->fetch()){

              $data = explode("-", $hs_sel_estoque_dados['data_saida']);//Divide uma string em strings//

              $porcentagem = ($hs_sel_estoque_dados['lucro_bruto']/100)*$hs_sel_estoque_dados['valor_compra']; //descobrindo a porcentagem correspondente ao preço
              $valorunit = $hs_sel_estoque_dados['valor_compra']+$porcentagem; //somando ao valor de compra para obter o valor de venda
              $valortotal = $valorunit*$hs_sel_estoque_dados['quantidade']; //multiplicando pela quantidade de produtos retirados para obter o valor total.

        ?>
        <tr>
          <td><?php echo $hs_sel_estoque_dados['produtos_nome']; ?></td>
          <td><?php echo $hs_sel_estoque_dados['categoria_nome']; ?></td>
          <td><?php echo $hs_sel_estoque_dados['marca_nome']; ?></td>
          <td><?php echo $hs_sel_estoque_dados['quantidade']; ?></td>
          <td><?php echo number_format($valortotal,2,',',''); ?></td>
          <td><?php echo $data['2']."/".$data['1']."/".$data['0']; ?></td>
          <td><?php echo $hs_sel_estoque_dados['observacoes'] ?></td>
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
  </form>
  </div>
