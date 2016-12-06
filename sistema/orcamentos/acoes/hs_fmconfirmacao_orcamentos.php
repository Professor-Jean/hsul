<?php

 $g_id = $_GET['id'];

  $hs_sel_orcamentos = "SELECT * FROM orcamentos WHERE id='".$g_id."'";
  $hs_sel_orcamentos_preparado = $conexaobd->prepare($hs_sel_orcamentos);
  $hs_sel_orcamentos_preparado->execute();
  $hs_sel_orcamentos_dados = $hs_sel_orcamentos_preparado->fetch();
  ?>
<h2> Confirmação de Orçamento </h2>
<br/>
<div class="registros">
<form name="frmconfirmacao" method="post" action="?pasta=orcamentos/acoes/&arq=hs_confirmacao_orcamentos&ext=php">
<input type="hidden" name="hidid" value="<?php echo $hs_sel_orcamentos_dados['id']; ?>">
<table style="padding: 15px;">
  <tr>
    <td colspan="2" class="obg">Campos com (*) são obrigatórios.</td>
  </tr>
  <tr>
	<td> *Data de início: </td>
	<td> <input type="text" name="txtdata" id="datepicker" placeholder="DD/MM/AAAA" readonly/> </td>
  </tr>
  <tr>
	<td> Comentário: </td>
	<td> <textarea type="text" name="txtcomentario"></textarea> </td>
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
