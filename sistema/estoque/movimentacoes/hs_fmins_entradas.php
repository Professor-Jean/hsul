        <h2> Movimentação de Entrada de Estoque</h2>
        <script>

        function mostraProdutos(){

          id_categoria = $('#selcategoria').val();

          id_marca = $('#selmarca').val();


          $('#selprodutos_id').html("<option>Aguarde</option>");

          $.ajax({
            type: "post",
            url: "../adicionais/php/hs_buscadinamica_produtos_php.php",
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
            <form name="frmcadentrada" method="POST" action="?pasta=estoque/movimentacoes/&arq=hs_ins_entradas&ext=php" onsubmit="return validacaomoventrada()">
            <table>
              <tr>
                <td colspan="2" class="obg">Campos com (*) são obrigatórios.</td>
              </tr>
              <tr>
                <td>*Categoria: </td>
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
                <td>*Marca: </td>
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
                <td>*Quantidade:</td>
                <td><input type="text" name="txtquantidade" maxlength="4"/></td>
              </tr>
              <tr>
                <td>*Valor unitário do produto:</td>
                <td><input type="text" name="txtvalorcompra" maxlength="8"/></td>
              </tr>
              <tr>
                <td>*Data de entrada:</td>
                <td><input type="text" id="datepicker" name="txtdataentrada" placeholder="dd/mm/aaaa" maxlength="10"/></td>
              </tr>
              <tr>
                <td>Observações:</td>
                <td><textarea type="text" name="txaobservacao" maxlength="1500"></textarea></td>
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
          $hs_sel_estoque = "SELECT produtos.id AS produtos_id, produtos.categorias_id, categorias.nome AS categorias, produtos.marcas_id, marcas.nome AS marcas, produtos.nome AS produto_nome, entradasestoque.quantidade, entradasestoque.valor_compra, entradasestoque.data_entrada, entradasestoque.observacoes FROM entradasestoque INNER JOIN produtos ON entradasestoque.produtos_id=produtos.id INNER JOIN categorias ON produtos.categorias_id=categorias.id INNER JOIN marcas ON produtos.marcas_id=marcas.id";

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
                <th>Valor de Unitário</th>
                <th>Data de entrada</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if($hs_sel_estoque_preparado->rowCount()>0){
                  while($hs_sel_estoque_dados = $hs_sel_estoque_preparado->fetch()){
                    $data = explode("-", $hs_sel_estoque_dados['data_entrada']);//Divide uma string em strings//
              ?>
              <tr>
                <td><?php echo $hs_sel_estoque_dados['produto_nome']; ?></td>
        				<td><?php echo $hs_sel_estoque_dados['categorias']; ?></td>
                <td><?php echo $hs_sel_estoque_dados['marcas']; ?></td>
                <td><?php echo $hs_sel_estoque_dados['quantidade']; ?></td>
                <td><?php echo number_format($hs_sel_estoque_dados['valor_compra'],2,',','');?></td>
                <td><?php echo $data['2']."/".$data['1']."/".$data['0']; ?></td>
                <!--<td align="center"><a href="?pasta=estoque/movimentacoes/&arq=hs_fmupd_entradas&ext=php&id=<?php echo $hs_sel_estoque_dados['produtos_id'];?>" title="Editar registro" onClick="return confirmar"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>-->
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
