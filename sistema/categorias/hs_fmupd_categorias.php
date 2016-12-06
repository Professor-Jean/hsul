<h2> Registro de Categorias </h2>
<?php

  $g_id = $_GET['id'];

  $hs_sel_categorias = "SELECT * FROM categorias WHERE id='".$g_id."'";
  $hs_sel_categorias_preparado = $conexaobd->prepare($hs_sel_categorias);
  $hs_sel_categorias_preparado->execute();
  $hs_sel_categorias_dados = $hs_sel_categorias_preparado->fetch();

?>

<div>
  <div class="registros">
    <br />
    <form name="frmcadcategorias" method="post" action="?pasta=categorias/&arq=hs_upd_categorias&ext=php" onsubmit="return validacaocategorias()">
      <input type="hidden" name="hidid" value="<?php echo $hs_sel_categorias_dados['id']; ?>">
      <table>
        <tr>
          <td colspan="2" class="obg">Campos com (*) são obrigatórios.</td>
        </tr>
        <tr>
          <td> *Nome: </td>
          <td> <input type="text" name="txtnome" maxlength="20" value="<?php echo $hs_sel_categorias_dados['nome']; ?>"/> </td>
        </tr>
        <tr>
          <td> *Margem de lucro: </td>
          <td> <input type="text" name="txtlucro" maxlength="20" value="<?php echo $hs_sel_categorias_dados['lucro_bruto']; ?>"/> </td>
        </tr>
        <tr>
          <td> Descrição: </td>
          <td> <textarea type="text" name="txtdescricao"><?php echo $hs_sel_categorias_dados['descricao']; ?> </textarea> </td>
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
