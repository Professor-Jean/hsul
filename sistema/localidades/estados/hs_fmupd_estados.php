<?php

  $g_id = $_GET['id'];

  $hs_sel_estados = "SELECT * FROM estados WHERE id='".$g_id."'";
  $hs_sel_estados_preparado = $conexaobd->prepare($hs_sel_estados);
  $hs_sel_estados_preparado->execute();
  $hs_sel_estados_dados = $hs_sel_estados_preparado->fetch();

?>
<h2> Registro de Estado </h2>
<div>
  <div class="registros">
    <br />
    <form name="frmcadestados" method="post" action="?pasta=localidades/estados/&arq=hs_upd_estados&ext=php" onsubmit="return validacaoestados()">
      <input type="hidden" name="hidid" value="<?php echo $hs_sel_estados_dados['id']; ?>">
      <table>
        <tr>
          <td> Nome do estado: </td>
          <td> <input type="text" name="txtnome" value="<?php echo $hs_sel_estados_dados['nome']; ?>"> </td>
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
