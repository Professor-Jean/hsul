<h2>Registro de Marca do Produto</h2>
<?php

  $hs_sel_marcas = "SELECT * FROM marcas";

  $hs_sel_marcas_preparado = $conexaobd->prepare($hs_sel_marcas);

  $hs_sel_marcas_preparado->execute();
?>
<div>
  <div class="registros">
    <form name="frmcadmarcas" enctype="multipart/form-data" method="POST" action="?pasta=marcas/&arq=hs_ins_marcas&ext=php" onsubmit="return validarmarcas()">
    <table>
      <tr>
        <td colspan="2" class="obg">Campos com (*) são obrigatórios.</td>
      </tr>
      <tr>
        <td>*Nome: </td>
        <td><input type="text" name="txtnome" maxlength="45"/></td>
      </tr>
      <tr>
        <td>*Imagem: </td>
        <td><input type="file" name="flimage" required/></td>
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
  <table>
    <thead>
      <tr>
        <th>Nome</th>
        <th>Imagem</th>
        <th>Editar</th>
        <th>Excluir</th>
      </tr>
    </thead>
    <tbody>
      <?php
        if($hs_sel_marcas_preparado->rowCount()>0){
          while($hs_sel_marcas_dados = $hs_sel_marcas_preparado->fetch()){

      ?>
  			<tr>
  				<td><?php echo $hs_sel_marcas_dados['nome']; ?></td>
          <td><img src="../adicionais/marcas_imagens/<?php echo $hs_sel_marcas_dados['imagem']; ?>" width="100px" height="60px"></td>
  				<td align="center"><a href="?pasta=marcas/&arq=hs_fmupd_marcas&ext=php&id=<?php echo $hs_sel_marcas_dados['id'];?>" title="Editar registro"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>

          <td align="center"><a title="Excluir registro"><?php echo confirmacao_exclusao($hs_sel_marcas_dados['id'], 'vazio', '?pasta=marcas/&arq=hs_del_marcas&ext=php', 'esse/a marca', $hs_sel_marcas_dados['nome']);?></a></td>
  			</tr>
        <?php
            }//fechando a estrutura de repeticao//
          }else{
        ?>
        <tr>
          <td align="center" colspan="5">Não há registros.</td>
        </tr>
        <?php
          }
        ?>
    </tbody>
  </table>
</div>
