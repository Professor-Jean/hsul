 <h2>Registro de Produto</h2>
  <?php
      $g_id = $_GET['id'];

      $hs_sel_produtos = "SELECT * FROM produtos WHERE  id='".$g_id."'";//sempre colocar * no select//

      $hs_sel_produtos_preparado = $conexaobd->prepare($hs_sel_produtos);//preparando para fazer a conexaobd//

      $hs_sel_produtos_preparado->execute();//preparando para ser executado//

      $hs_sel_produtos_dados = $hs_sel_produtos_preparado->fetch();

     ?>

<div>
 <div class="registros">
		<form name="frmaltprodutos"  enctype="multipart/form-data" method="POST" action="?pasta=produtos/registros/&arq=hs_upd_produtos&ext=php" onsubmit="return validaraltprodutos()">
      <input type="hidden" name="hidid" value="<?php echo $hs_sel_produtos_dados['id'];?>" />
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

                  if($id_categorias==$hs_sel_produtos_dados['categorias_id']){
                    echo "<option selected value='".$id_categorias."'>".$nome_categorias."</option>";
                  }else{
                    echo "<option value='".$id_categorias."'>".$nome_categorias."</option>";
                  }
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

                  if($id_marcas==$hs_sel_produtos_dados['marcas_id']){
                    echo "<option selected value='".$id_marcas."'>".$nome_marcas."</option>";
                  }else{
                    echo "<option value='".$id_marcas."'>".$nome_marcas."</option>";
                  }
                }
                ?>
            </select>
          </td>
        </tr>
        <tr>
					<td>*Nome:</td>
				  <td><input type="text" name="txtnome" maxlenght="45" value=<?php echo $hs_sel_produtos_dados['nome'];?>></td>
				</tr>
        <tr>
					<td>*Imagem:</td>
				  <td><input type="file" name="flimage"></td>
          <td><img src="../adicionais/produtos_imagens/<?php echo $hs_sel_produtos_dados['imagem']; ?>" width="60px" height="60px"></td>
				</tr>
				<tr>
					<td>*Quantidade Miníma:</td>
					<td><input name="txtminima" maxlenght="4" value=<?php echo $hs_sel_produtos_dados['quantidade_minima']; ?>></td>
				</tr>
        <tr>
          <td>Descrição: </td>
          <td><textarea name="txadescricao" maxlenght="1500"><?php echo $hs_sel_produtos_dados['descricao'];?></textarea></td>
        </tr>
        <tr>
          <td colspan="2"><?php
          if($hs_sel_produtos_dados['produtos_diversos']=="1"){
              echo "Produtos Diversos! <br/>";
            }else{
              echo "Produtos Grandes! <br/>";
            }
          ?></td>

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
