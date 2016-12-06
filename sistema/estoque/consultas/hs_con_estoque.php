<span class="imprimir">
<h2>Consulta de Estoque</h2>
</span>
<form action="../adicionais/php/hs_construirpdf_php.php" id="gearpdf" method="POST" onsubmit="return catchContent()">
    <input type="hidden" name="dadospdf" id="dadospdf" value="">
    <button type="submit" id="pdf">Gerar PDF</button>
</form>

<?php

  $hs_sel_estoque = "SELECT produtos.id AS produtos_id, categorias.id AS categorias_id, categorias.nome AS categorias, categorias.lucro_bruto, marcas.id AS marcas_id, marcas.nome AS marcas, produtos.nome AS produto_nome, SUM(entradasestoque.valor_compra) AS valor_total, estoques.quantidade FROM produtos INNER JOIN categorias ON produtos.categorias_id=categorias.id INNER JOIN marcas ON produtos.marcas_id=marcas.id INNER JOIN entradasestoque ON entradasestoque.produtos_id=produtos.id INNER JOIN estoques ON estoques.produtos_id=produtos.id";

    if((isset($_POST['txtcodigo']))||(isset($_POST['selcategoria']))||(isset($_POST['selmarca']))||(isset($_POST['txtnome']))){
        $hs_sel_estoque.=" WHERE ";

          $p_codigo = $_POST['txtcodigo']; // coloca o post em uma variável para facilitar
          $hs_sel_estoque.=" produtos.id LIKE '%".$p_codigo."%' AND"; //e completa a sintaxe

          $p_categoria = $_POST['selcategoria'];// coloca o post em uma variável para facilitar
          $hs_sel_estoque.=" categorias.id LIKE '%".$p_categoria."%' AND";//e completa a sintaxe

          $p_marca = $_POST['selmarca'];// coloca o post em uma variável para facilitar
          $hs_sel_estoque.=" marcas.id LIKE '%".$p_marca."%' AND";//e completa a sintaxe

          $p_nome = $_POST['txtnome'];
          $hs_sel_estoque.= " produtos.nome LIKE '%".$p_nome."%' AND";

        $hs_sel_estoque = substr($hs_sel_estoque, 0, -3); //substr para tirar os 3 ultimos itens que são o 'and'

        $hs_sel_estoque .= " GROUP BY produtos.id";

      }else{
        $hs_sel_estoque .= " GROUP BY produtos.id";
      }

    $hs_sel_estoque_preparado = $conexaobd->prepare($hs_sel_estoque); //preparando

    $hs_sel_estoque_preparado->execute(); //executando
    //echo $hs_sel_estoque;
?>
  <div>
    <div class="registros_filtro">
      <fieldset>
        <legend>Filtro de Pesquisa</legend>
        <form name="frmcadcestoque" method="POST" action="" onsubmit="return validarconestoque()">
          <table>
            <tr>
              <td>Código: </td>
              <td><input name="txtcodigo" placeholder="Só números" maxlength="6"/></td>
            </tr>
            <tr>
              <td>Categoria: </td>
              <td>
                <select name="selcategoria">
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
              <td>Marca: </td>
              <td>
                <select name="selmarca">
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
              <td>Nome:</td>
              <td><input name="txtnome" maxlength="45"/></td>
            </tr>
            <tr align="center">
              <td>
                <button type="reset">Limpar</button>
              </td>
              <td>
                <button type="submit">Pesquisar</button>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </fieldset>
    <span class="imprimir">
    <div class="consultas">
      <table>
        <thead>
          <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Categoria</th>
            <th>Marca</th>
            <th>Quantidade</th>
            <th>Valor total por produtos</th>
          </tr>
        </thead>
        <tbody>
          <?php

          $preco = 0;
          $lucro = 0;
          $totalestoque = 0;
          $totalprodutos = 0;


            if($hs_sel_estoque_preparado->rowCount()>0){
              while($hs_sel_estoque_dados = $hs_sel_estoque_preparado->fetch()){


                  $lucro = ($hs_sel_estoque_dados['lucro_bruto']/100)*$hs_sel_estoque_dados['valor_total'];

                  $preco = $hs_sel_estoque_dados['valor_total']+ $lucro;

                  $totalprodutos = $preco * $hs_sel_estoque_dados['quantidade'];

                  $totalestoque =  $totalestoque + $totalprodutos;

          ?>
          <tr>
            <td><?php echo $hs_sel_estoque_dados['produtos_id'];?></td>
            <td><?php echo $hs_sel_estoque_dados['produto_nome'];?></td>
            <td><?php echo $hs_sel_estoque_dados['categorias'];?></td>
            <td><?php echo $hs_sel_estoque_dados['marcas'];?></td>
            <td><?php echo $hs_sel_estoque_dados['quantidade'];?></td>
            <td><?php echo number_format($totalprodutos,2,',','');?></td>
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
            <tr>
              <th colspan="5">Valor total em estoque</th>
              <td><?php echo number_format($totalestoque,2,',','');?></td>
            </tr>
        </tbody>
      </table>
      </span>
    </form>
    </div>
