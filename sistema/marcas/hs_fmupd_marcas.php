<h2>Registro de Marca do Produto</h2>
  <?php
      $g_id = $_GET['id'];

      $hs_sel_marcas = "SELECT * FROM marcas WHERE  id='".$g_id."'";//sempre colocar * no select//

      $hs_sel_marcas_preparado = $conexaobd->prepare($hs_sel_marcas);//preparando para fazer a conexaobd//

      $hs_sel_marcas_preparado->execute();//preparando para ser executado//

      $hs_sel_marcas_dados = $hs_sel_marcas_preparado->fetch();

     ?>
<div>
 <div class="registros">
		<form name="frmaltmarcas" method="POST" enctype="multipart/form-data" action="?pasta=marcas/&arq=hs_upd_marcas&ext=php" onsubmit="return validaraltmarcas()">
      <input type="hidden" name="hidid" value="<?php echo $hs_sel_marcas_dados['id'];?>" />
			<table>
        <tr>
          <td colspan="2" class="obg">Campos com (*) são obrigatórios.</td>
        </tr>
				<tr>
					<td>*Nome:</td>
				  <td><input type="text" name="txtnome" value="<?php echo $hs_sel_marcas_dados['nome'];?>" maxlenght="45"></td>
        </tr>
				<tr>
					<td>*Imagem:</td>
					<td><input type="file" name="flimage"></td>
          <td><img src="../adicionais/marcas_imagens/<?php echo $hs_sel_marcas_dados['imagem'];?>" width="60px" height="60px"></td>
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
