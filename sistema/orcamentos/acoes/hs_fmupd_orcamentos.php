<h2> Alterar Orçamento </h2>
<?php
$g_id = $_GET['id'];

$hs_sel_orcamentos = "SELECT orcamentos.*, funcionarios.nome_completo AS nome, funcionarios.id AS id_funcionarios, estados.id AS estados_id FROM orcamentos INNER JOIN funcionarios ON orcamentos.funcionarios_id=funcionarios.id INNER JOIN clientes ON orcamentos.clientes_id=clientes.id INNER JOIN cidades ON orcamentos.cidades_id=cidades.id INNER JOIN estados ON cidades.estados_id=estados.id WHERE orcamentos.id='".$g_id."'";
$hs_sel_orcamentos_preparado = $conexaobd->prepare($hs_sel_orcamentos);
$hs_sel_orcamentos_preparado->execute();
$hs_sel_orcamentos_dados = $hs_sel_orcamentos_preparado->fetch();

$data = explode("-", $hs_sel_orcamentos_dados['data_validade']);

?>
 <div class="registros_orc">
   <form name="frmcadorcamentos" method="post" action="?pasta=orcamentos/acoes/&arq=hs_upd_orcamentos&ext=php" onsubmit="return validacaoorcamentos()">
   <input type="hidden" name="hidid" value="<?php echo $g_id; ?>"/>
     <?php

     ?>
     <script>
   function mostraCidades(){

           id_estado = $('#selestado').val();

           $('#selcidade').html("<option>Aguarde</option>");

           $.post("../adicionais/php/hs_buscadinamica_php.php", {id:id_estado},
           function(dados){
               $('#selcidade').html(dados);
             }
           );
         }

     </script>
     <table>
   <tr>
     <td colspan="2" align="center" style="padding-right: 120px;">Campos com (*) são obrigatórios.</td>
   </tr>
       <tr>
         <td> Nome do Funcionario: </td>
         <td> <input type="txt" name="txtfuncionario" readonly="readonly" value="<?php echo $hs_sel_orcamentos_dados['nome'];?>"/></td>
       </tr>
       <tr>
         <td> *Nome do cliente: </td>
         <td>
           <select name="selclientes">
             <option value="">Selecione..</option>
             <?php

               $hs_sel_clientes = "SELECT * FROM clientes ORDER BY nome ASC";
               $hs_sel_clientes_preparado = $conexaobd->prepare($hs_sel_clientes);
               $hs_sel_clientes_preparado->execute();

               if($hs_sel_clientes_preparado->rowCount()>0){
                  while ($hs_sel_clientes_dados = $hs_sel_clientes_preparado->fetch()) {
                    $selected   = "";

                    if($hs_sel_clientes_dados['id']==$hs_sel_orcamentos_dados['clientes_id']){
                      $selected = "selected";
                    }
                    echo "<option value='".$hs_sel_clientes_dados['id']."'".$selected.">".$hs_sel_clientes_dados['nome']."</option>";
                  }
                }
             ?>
           </select>
         </td>
       </tr>
       <tr>
         <td colspan="2">
           <div class="mestre_detalhes_reg">
             <h5>Produtos</h5>
             <table>
               <tr>
                 <td>Categoria:</td>
                 <td>Marca:</td>
                 <td>Nome do produto:</td>
                 <td>Qntd. por produto:</td>
               </tr>
			   <?php

			    $hs_sel_orc_produtos = "SELECT produtos.id AS produtos_id, produtos.produtos_diversos, orcamentos_has_produtos.orcamentos_id, orcamentos_has_produtos.produtos_id AS id_produtos, orcamentos_has_produtos.quantidade_por_produto AS quantidade, produtos.categorias_id AS categorias_id, produtos.marcas_id AS marcas_id FROM orcamentos_has_produtos INNER JOIN produtos ON orcamentos_has_produtos.produtos_id=produtos.id WHERE orcamentos_has_produtos.orcamentos_id='".$g_id."' AND produtos.produtos_diversos='2'";
			    $hs_sel_orc_produtos_preparado = $conexaobd->prepare($hs_sel_orc_produtos);
			    $hs_sel_orc_produtos_preparado->execute();

			   if($hs_sel_orc_produtos_preparado->rowCount()>0){
				  while ($hs_sel_orc_produtos_dados = $hs_sel_orc_produtos_preparado->fetch()){

          $sql_sel_produtos = "SELECT produtos.id AS produtoid, entradasestoque.id, entradasestoque.quantidade AS quantidades, entradasestoque.valor_compra AS valor_compra, categorias.id, categorias.lucro_bruto AS lucro FROM produtos INNER JOIN entradasestoque ON entradasestoque.produtos_id=produtos.id INNER JOIN categorias ON produtos.categorias_id=categorias.id WHERE produtos.id='".$hs_sel_orc_produtos_dados['id_produtos']."'";
          $sql_sel_produtos_preparado = $conexaobd->prepare($sql_sel_produtos);
          $sql_sel_produtos_preparado->execute();
          $sql_sel_produtos_dados = $sql_sel_produtos_preparado->fetch();

          $total=0;

          $valor_compra = $sql_sel_produtos_dados['valor_compra'];
          $lucro = $sql_sel_produtos_dados['lucro'];

          $lucro_emcima = $valor_compra * $lucro / 100;
          $valor_total = $valor_compra + $lucro_emcima;

          $total += $valor_total * $hs_sel_orc_produtos_dados['quantidade'];

					$hs_sel_catmac = "SELECT produtos.id, produtos.nome AS nome_produtos, marcas.nome AS nome_marcas, categorias.nome AS nome_categoria FROM produtos INNER JOIN marcas ON produtos.marcas_id=marcas.id INNER JOIN categorias ON produtos.categorias_id=categorias.id WHERE produtos.id='".$hs_sel_orc_produtos_dados['produtos_id']."'";
					$hs_sel_catmac_preparado = $conexaobd->prepare($hs_sel_catmac);
					$hs_sel_catmac_preparado->execute();
					$hs_sel_catmac_dados = $hs_sel_catmac_preparado->fetch();

			   ?>
               <tr class="linhas" id="id__0">
                 <td><input type="txt" name="txtcategoria" value="<?php echo $hs_sel_catmac_dados['nome_categoria']; ?>" readonly></td>
                 <td><input type="txt" name="txtmarca" value="<?php echo $hs_sel_catmac_dados['nome_marcas']; ?>" readonly></td>
                 <td><input type="txt" name="txtproduto" value="<?php echo $hs_sel_catmac_dados['nome_produtos']; ?>" readonly></td>
                 <td><input type="txt" name="txtquantidade" value="<?php echo $hs_sel_orc_produtos_dados['quantidade'];?>" readonly></td>
               </tr>
			   <?php
				}
				}
				?>
             </table>
           </div>
         </td>
       </tr>
       <tr>
         <td colspan="2">
           <div class="mestre_detalhes_reg">
             <h5>Produtos Diversos:</h5>
             <table>
               <tr>
                 <td>Categoria:</td>
                 <td>Marca:</td>
                 <td>Nome do produto:</td>
                 <td>Qntd. por produto:</td>
               </tr>
			   <?php

			    $hs_sel_orc_produtos2 = "SELECT produtos.id AS produtos_id, produtos.produtos_diversos, orcamentos_has_produtos.orcamentos_id,  orcamentos_has_produtos.quantidade_por_produto AS quantidade, orcamentos_has_produtos.produtos_id AS id_produtos, produtos.categorias_id AS categorias_id, produtos.marcas_id AS marcas_id FROM orcamentos_has_produtos INNER JOIN produtos ON orcamentos_has_produtos.produtos_id=produtos.id WHERE orcamentos_has_produtos.orcamentos_id='".$g_id."' AND produtos.produtos_diversos='1'";
			    $hs_sel_orc_produtos_preparado2 = $conexaobd->prepare($hs_sel_orc_produtos2);
			    $hs_sel_orc_produtos_preparado2->execute();

			   if($hs_sel_orc_produtos_preparado2->rowCount()>0){
				  while ($hs_sel_orc_produtos_dados2 = $hs_sel_orc_produtos_preparado2->fetch()){

          $sql_sel_produtos2 = "SELECT produtos.id AS produtoid, entradasestoque.id, entradasestoque.quantidade AS quantidades, entradasestoque.valor_compra AS valor_compra, categorias.id, categorias.lucro_bruto AS lucro FROM produtos INNER JOIN entradasestoque ON entradasestoque.produtos_id=produtos.id INNER JOIN categorias ON produtos.categorias_id=categorias.id WHERE produtos.id='".$hs_sel_orc_produtos_dados2['id_produtos']."'";
          $sql_sel_produtos_preparado2 = $conexaobd->prepare($sql_sel_produtos2);
          $sql_sel_produtos_preparado2->execute();
          $sql_sel_produtos_dados2 = $sql_sel_produtos_preparado2->fetch();

          $total2=0;

          $valor_compra2 = $sql_sel_produtos_dados2['valor_compra'];
          $lucro2 = $sql_sel_produtos_dados2['lucro'];

          $lucro_emcima2 = $valor_compra2 * $lucro2 / 100;
          $valor_total2 = $valor_compra2 + $lucro_emcima2;

          $total2 += $valor_total2 * $hs_sel_orc_produtos_dados2['quantidade'];

					$hs_sel_catmac2 = "SELECT produtos.id, produtos.nome AS nome_produtos, marcas.nome AS nome_marcas, categorias.nome AS nome_categoria FROM produtos INNER JOIN marcas ON produtos.marcas_id=marcas.id INNER JOIN categorias ON produtos.categorias_id=categorias.id WHERE produtos.id='".$hs_sel_orc_produtos_dados2['produtos_id']."'";
					$hs_sel_catmac_preparado2 = $conexaobd->prepare($hs_sel_catmac2);
					$hs_sel_catmac_preparado2->execute();
					$hs_sel_catmac_dados2 = $hs_sel_catmac_preparado2->fetch();
			   ?>
               <tr class="linhasdiversos" id="id__0">
                 <td><input type="txt" name="txtcategoriap" value="<?php echo $hs_sel_catmac_dados2['nome_categoria']; ?>" readonly></td>
                 <td><input type="txt" name="txtmarcap" value="<?php echo $hs_sel_catmac_dados2['nome_marcas']; ?>" readonly></td>
                 <td><input type="txt" name="txtprodutop" value="<?php echo $hs_sel_catmac_dados2['nome_produtos']; ?>" readonly></td>
                 <td><input type="text" name="txtquantindadep[]" value="<?php echo $hs_sel_orc_produtos_dados2['quantidade'];?>" readonly></td>
               </tr>
			   <?php
				}
			   }else{
           $total2= 0;
         ?>
			   <tr class="linhasdiversos" id="id__0">
                 <td>---</td>
                 <td>---</td>
                 <td>---</td>
                 <td>---</td>
               </tr>
			   <?php
			   }
			   ?>
             </table>
           </div>
         </td>
       </tr>
       <?php

      $valor_total_produtos = $total + $total2;

       ?>
       <tr>
         <td> Valor total produtos: </td>
         <td> <input id="valortotalprodutos" readonly="readonly" value="<?php echo $valor_total_produtos;?>"/></td>
       </tr>
       <tr>
         <td> Valor da mão de obra: </td>
         <td> <input type="text" id="maodeobra" name="txtmaodeobra" maxlength="10" placeholder="000" onkeydown="valorTotalIncorreto()" value="<?php echo $hs_sel_orcamentos_dados['valor_mao_de_obra']; ?>"
		 readonly/> </td>
       </tr>
       <tr>
         <td> Desconto: </td>
         <td> <input type="text" id="descontoorc" name="txtdesconto" maxlength="7" placeholder="Porcentagem (ex.: 10)" onkeydown="valorTotalIncorreto()" value="<?php echo $hs_sel_orcamentos_dados['desconto']; ?>" readonly/> </td>
       </tr>
       <?php

       $valor_total_produtos = $total2 + $total;
       $valor_mao_de_obra = $valor_total_produtos + $hs_sel_orcamentos_dados['valor_mao_de_obra'];
       $valor_desconto = ($valor_total_produtos + $valor_mao_de_obra) * $hs_sel_orcamentos_dados['desconto'] / 100;
       $valor_final = $valor_mao_de_obra - $valor_desconto;

       ?>
       <tr>
         <td> Valor Total: </td>
         <td> <input id="valorTotalOrc" readonly="readonly" value="<?php echo $valor_final; ?>"/></td>
       </tr>
       <tr>
         <td> *Data de Validade: </td>
         <td> <input type="text" name="txtdatadevalidade" id="datepicker" value="<?php echo $data[2]."/".$data[1]."/".$data[0]; ?>" placeholder="DD/MM/AAAA" readonly/> </td>
       </tr>
       <tr>
         <td> *CEP: </td>
         <td> <input type="text" name="txtcep" maxlength="10" value="<?php echo $hs_sel_orcamentos_dados['cep']; ?>" placeholder="00000000"/> </td>
       </tr>
       <tr>
         <td> *Estado: </td>
         <td>
           <select name="selestado" id="selestado" onchange="mostraCidades()">
             <option value="">Selecione..</option>
             <?php

               $sql_sel_estados = "SELECT * FROM estados";

               $sql_sel_estados_preparado = $conexaobd->prepare($sql_sel_estados);

               $sql_sel_estados_preparado->execute();

               if($sql_sel_estados_preparado->rowCount()>0){
                  while ($hs_sel_estados_dados = $sql_sel_estados_preparado->fetch()) {
                    $selected   = "";

                    if($hs_sel_estados_dados['id']==$hs_sel_orcamentos_dados['estados_id']){
                      $selected = "selected";
                    }
                    echo "<option value='".$hs_sel_estados_dados['id']."'".$selected.">".$hs_sel_estados_dados['nome']."</option>";
                  }
                }
             ?>
           </select>
         </td>
       </tr>
       <tr>
         <td> *Cidade: </td>
         <td>
           <select name="selcidade" id="selcidade">
             <option value="">Selecione..</option>
			 <?php

               $sql_sel_cidades = "SELECT * FROM cidades";

               $sql_sel_cidades_preparado = $conexaobd->prepare($sql_sel_cidades);

               $sql_sel_cidades_preparado->execute();

               if($sql_sel_cidades_preparado->rowCount()>0){
                  while ($hs_sel_cidades_dados = $sql_sel_cidades_preparado->fetch()) {
                    $selected   = "";

                    if($hs_sel_cidades_dados['id']==$hs_sel_orcamentos_dados['cidades_id']){
                      $selected = "selected";
                    }
                    echo "<option value='".$hs_sel_cidades_dados['id']."'".$selected.">".$hs_sel_cidades_dados['nome']."</option>";
                  }
                }
             ?>
           </select>
         </td>
       </tr>
       <tr>
         <td> *Bairro: </td>
         <td> <input type="text" name="txtbairro" maxlength="30" value="<?php echo $hs_sel_orcamentos_dados['bairro']; ?>" placeholder="Costa e Silva"/> </td>
       </tr>
       <tr>
         <td> *Logradouro: </td>
         <td> <input type="text" name="txtlogradouro" maxlength="60" value="<?php echo $hs_sel_orcamentos_dados['logradouro']; ?>" placeholder="Rua Marquês de Olinda"/> </td>
       </tr>
       <tr>
         <td> *Número da residência: </td>
         <td> <input type="text" name="txtnumeroresidencia" maxlength="5" value="<?php echo $hs_sel_orcamentos_dados['numero_local']; ?>" placeholder="0000"/> </td>
       </tr>
       <tr>
         <td> *Complemento: </td>
         <td> <input type="text" name="txtcomplemento" maxlength="20" value="<?php echo $hs_sel_orcamentos_dados['complemento']; ?>" placeholder="Casa"/> </td>
       </tr>
       <tr>
         <td> Comentário: </td>
         <td> <textarea type="text" name="txtcomentario" value="<?php echo $hs_sel_orcamentos_dados['descricao']; ?>"></textarea> </td>
       </tr>
       <tr align="center">
         <td colspan="2">
           <button type="reset">Limpar</button>
           <button type="submit" class="teste">Salvar</button>
         </td>
       </tr>
     </table>
   </form>
 </div>
