<h2> Registro de Categorias </h2>
<div>
  <div class="registros">
    <br />
    <form name="frmcadcategorias" method="post" action="?pasta=categorias/&arq=hs_ins_categorias&ext=php" onsubmit="return validacaocategorias()">
      <table>
        <tr>
          <td colspan="2" class="obg">Campos com (*) são obrigatórios.</td>
        </tr>
        <tr>
          <td> *Nome: </td>
          <td> <input type="text" name="txtnome" maxlength="20"/> </td>
        </tr>
        <tr>
          <td> *Margem de lucro: </td>
          <td> <input type="text" name="txtlucro" maxlength="20" placeholder="Porcentagem (Ex.: 00)"/> </td>
        </tr>
        <tr>
          <td> Descrição: </td>
          <td><textarea type="text" name="txtdescricao"></textarea></td>
        </tr>
        <tr>
          <td colspan="2"><br /></td>
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
<?php

$hs_sel_categorias = "SELECT * FROM categorias";
$hs_sel_categorias_preparado = $conexaobd->prepare($hs_sel_categorias);
$hs_sel_categorias_preparado->execute();

?>
<div class="consultas">
  <table>
    <thead>
      <tr>
        <th width="40%">Nome</th>
        <th width="40%">Descrição</th>
        <th width="10%">Editar</th>
        <th width="10%">Excluir</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if($hs_sel_categorias_preparado->rowCount() > 0){
        while($hs_sel_categorias_dados = $hs_sel_categorias_preparado->fetch()){
      ?>
      <tr>
        <td><?php echo $hs_sel_categorias_dados['nome']; ?></td>
        <td><?php echo $hs_sel_categorias_dados['descricao']; ?></td>
        <td align="center"><a href="?pasta=categorias/&arq=hs_fmupd_categorias&ext=php&id=<?php echo $hs_sel_categorias_dados['id'];?>" title="Editar categoria"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
        <td align="center"><?php echo confirmacao_exclusao($hs_sel_categorias_dados['id'], '', '?pasta=categorias/&arq=hs_del_categorias&ext=php', 'a categoria',  $hs_sel_categorias_dados['nome']); ?></a></td>
      </tr>
      <?php
        }
        }else{//fechando a estrutura de repetiçÃo
      ?>
      <tr>
        <td align="center" colspan="4">Não há registros</td>
      </tr>
      <?php
        }
      ?>
    </tbody>
  </table>
</div>
