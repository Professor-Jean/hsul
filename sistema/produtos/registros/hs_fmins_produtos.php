 <h2>Registro de Produto</h2>
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
    <form name="frmcadprodutos" method="POST" enctype="multipart/form-data" action="?pasta=produtos/registros/&arq=hs_ins_produtos&ext=php" onsubmit="return validarprodutos()">
      <table>
        <tr>
          <td colspan="2" class="obg">Campos com (*) são obrigatórios.</td>
        </tr>
        <tr>
          <td>*Categoria: </td>
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
          <td>*Marca: </td>
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
          <td>*Nome: </td>
          <td><input type="text" name="txtnome" maxlength="45"/></td>
        </tr>
        <tr>
          <td>*Imagem: </td>
          <td><input type="file" name="flimage" required/></td>
        </tr>
        <tr>
          <td>*Quantidade Mínima: </td>
          <td><input type="text" name="txtminima" maxlength="4"/></td>
        </tr>
        <tr>
          <td>Descrição: </td>
          <td><textarea name="txadescricao" maxlength="1500"></textarea></td>
        </tr>
        <tr>
          <td><input type="checkbox" class="pdiversos" name="produtosdiversos"><p class="pdiversos_p">Produtos Diversos</p></td>
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
    </form>
    </div>
  </div>
  <div class="consultas">
    <?php

      $hs_sel_produtos= "SELECT categorias.nome AS categorias, marcas.nome AS marcas, produtos.nome AS produto_nome, produtos.id, produtos.imagem,  produtos.quantidade_minima, produtos.descricao AS minima FROM produtos INNER JOIN categorias ON produtos.categorias_id=categorias.id INNER JOIN marcas ON produtos.marcas_id=marcas.id";

      $hs_sel_produtos_preparado = $conexaobd->prepare($hs_sel_produtos);

      $hs_sel_produtos_preparado->execute();

      ?>
    <table>
      <thead>
        <tr>
          <th>Categoria</th>
          <th>Marca</th>
          <th>Nome do produto</th>
          <th>Imagem</th>
          <th>Editar</th>
          <th>Excluir</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if($hs_sel_produtos_preparado->rowCount()>0){
            while($hs_sel_produtos_dados = $hs_sel_produtos_preparado->fetch()){

        ?>
    			<tr>
    				<td><?php echo $hs_sel_produtos_dados['categorias']; ?></td>
            <td><?php echo $hs_sel_produtos_dados['marcas']; ?></td>
            <td><?php echo $hs_sel_produtos_dados['produto_nome']; ?></td>
            <td><img src="../adicionais/produtos_imagens/<?php echo $hs_sel_produtos_dados['imagem']; ?>" width="65px" height="70px"></td>
            <td align="center"><a href="?pasta=produtos/registros/&arq=hs_fmupd_produtos&ext=php&id=<?php echo $hs_sel_produtos_dados['id'];?>" title="Editar registro"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
            <td align="center"><a title="Excluir registro"><?php echo confirmacao_exclusao($hs_sel_produtos_dados['id'], 'vazio', '?pasta=produtos/registros/&arq=hs_del_produtos&ext=php', 'o produto', $hs_sel_produtos_dados['produto_nome']);?></a></td>
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
  </div>
