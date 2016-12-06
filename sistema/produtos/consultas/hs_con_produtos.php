<span class="imprimir">
<h2>Consulta de Produtos</h2>
</span>
<form action="../adicionais/php/hs_construirpdf_php.php" id="gearpdf" method="POST" onsubmit="return catchContent()">
    <input type="hidden" name="dadospdf" id="dadospdf" value="">
    <button type="submit" id="pdf">Gerar PDF</button>
</form>
<?php

  $hs_sel_produtos = "SELECT produtos.id, categorias.id AS categorias_id, categorias.nome AS categorias, categorias.lucro_bruto, marcas.id AS marcas_id, marcas.nome AS marcas, marcas.imagem AS marcas_imagem, produtos.nome AS produto_nome, produtos.imagem AS produtos, produtos.descricao, entradasestoque.valor_compra, (((categorias.lucro_bruto/100)*entradasestoque.valor_compra)+entradasestoque.valor_compra) AS preco FROM produtos INNER JOIN categorias ON produtos.categorias_id=categorias.id INNER JOIN marcas ON produtos.marcas_id=marcas.id INNER JOIN entradasestoque ON entradasestoque.produtos_id=produtos.id";

    if((isset($_POST['txtcodigo']))||(isset($_POST['selcategoria']))||(isset($_POST['selmarca']))||(isset($_POST['txtnome']))||(isset($_POST['txtdpreco']))||(isset($_POST['txtapreco']))){
        $hs_sel_produtos.=" WHERE ";

          $p_codigo = $_POST['txtcodigo']; // coloca o post em uma variável para facilitar
          $hs_sel_produtos.=" produtos.id LIKE '%".$p_codigo."%' AND"; //e completa a sintaxe

          $p_categoria = $_POST['selcategoria'];// coloca o post em uma variável para facilitar
          $hs_sel_produtos.=" categorias_id LIKE '%".$p_categoria."%' AND";//e completa a sintaxe

          $p_marca = $_POST['selmarca'];// coloca o post em uma variável para facilitar
          $hs_sel_produtos.=" marcas_id LIKE '%".$p_marca."%' AND";//e completa a sintaxe

          $p_nome = $_POST['txtnome'];
          $hs_sel_produtos.= " produtos.nome LIKE '%".$p_nome."%' AND";

        if(($_POST['txtdpreco']!="")||($_POST['txtapreco']!="")){

          $hs_sel_produtos = substr($hs_sel_produtos, 0, -3);

          $p_dpreco = $_POST['txtdpreco'];
          $p_apreco = $_POST['txtapreco'];
          $hs_sel_produtos.= " HAVING preco BETWEEN '".$p_dpreco."' AND '".$p_apreco."' AND";

        }
        $hs_sel_produtos = substr($hs_sel_produtos, 0, -3); //substr para tirar os 3 ultimos itens que são o 'and'

      }

    $hs_sel_produtos_preparado = $conexaobd->prepare($hs_sel_produtos); //preparando

    $hs_sel_produtos_preparado->execute(); //executando

?>
  <div>
  <div class="registros_filtro">
    <fieldset>
      <legend>Filtro de Pesquisa</legend>
      <form name="frmcadcproduto" method="POST" action="?pasta=produtos/consultas/&arq=hs_con_produtos&ext=php" onsubmit="return validarconprodutos()">
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
            <td>Nome do produto:</td>
            <td><input type="text" name="txtnome" maxlength="45"/></td>
          </tr>
          <tr>
            <td>Preço:</td>
            <td class="preco"><input name="txtdpreco" maxlength="8" placeholder="De"/><input name="txtapreco" maxlength="8" placeholder="Até"/></td>
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
        </fieldset>
        </div>
        </div>
        <?php

        $preco = 0;
        $lucro = 0;

          if($hs_sel_produtos_preparado->rowCount()>0){
            while($hs_sel_produtos_dados = $hs_sel_produtos_preparado->fetch()){


                $lucro = ($hs_sel_produtos_dados['lucro_bruto']/100)*$hs_sel_produtos_dados['valor_compra'];

                $preco = $hs_sel_produtos_dados['valor_compra']+ $lucro;

        ?>
        <div class="produtosdaesquerda">
        <table>
          <tr>
            <td>
              <div class="img_dropdown">
                <img src="../adicionais/produtos_imagens/<?php echo $hs_sel_produtos_dados['produtos']; ?>" width="140px" height="140px">
                <div class="img_dropdown-content">
                <img src="../adicionais/produtos_imagens/<?php echo $hs_sel_produtos_dados['produtos']; ?>" width="215px" height="215px">
                </div>
              </div>
            </td>
            <td>
              <span class="imprimir">
              <p class="produtos_pdf" align="center"><?php echo $hs_sel_produtos_dados['id'];?></p>
              <p class="produtos_pdf" align="center"><?php echo $hs_sel_produtos_dados['produto_nome'];?></p>
              <p class="produtos_pdf" align="center"><?php echo $hs_sel_produtos_dados['categorias'];?></p>
              </span>
              <img src="../adicionais/marcas_imagens/<?php echo $hs_sel_produtos_dados['marcas_imagem']; ?>" width="50px" height="20px" style="margin-left: 90px;">
              <span class="imprimir">
              <p class="produtos_pdf" class="overflowprodutos"><?php echo $hs_sel_produtos_dados['descricao']; ?></p>
              <p class="produtos_pdf" align="center"><?php echo number_format($preco,2,',','');?></p>
              </span>
            </td>
          </tr>
        </table>
        </div>
        <?php
            }//fechando a estrutura de repeticao//
          }
        ?>
      </form>
    </div>
