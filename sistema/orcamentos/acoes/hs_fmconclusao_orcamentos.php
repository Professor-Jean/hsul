<h2>Conclusão de Serviço Orçado</h2>
<div>
  <div class="registros">
    <?php
      $g_id = $_GET['id'];

      $hs_sel_orcamentos = "SELECT comentario, data_inicio FROM orcamentos WHERE id='".$g_id."'";
      $hs_sel_orcamentos_preparado = $conexaobd->prepare($hs_sel_orcamentos);
      $hs_sel_orcamentos_preparado->execute();
      $hs_sel_orcamentos_dados = $hs_sel_orcamentos_preparado->fetch();
      if(isset($hs_sel_orcamentos_dados['comentario'])){
        $comentario = $hs_sel_orcamentos_dados['comentario'];
      }else{
        $comentario = "";
      }

      $data = explode("-", $hs_sel_orcamentos_dados['data_inicio']);
    ?>
    <form name="frmconclusao" action="?pasta=orcamentos/acoes/&arq=hs_conclusao_orcamentos&ext=php" method="post">
      <table>
        <input type="hidden" name="hidid" value="<?php echo $g_id ?>" />
        <tr>
          <td colspan="2" align="center">Campos com (*) são obrigatórios.</td>
        </tr>
        <tr>
          <td> Data do Serviço: </td>
          <td><input type="text" name="txtservico" value="<?php echo $data[2]."/".$data[1]."/".$data[0] ?>" readonly></td>
        </tr>
        <tr>
          <td> *Data de conclusão: </td>
          <td><input type="text" id="datepicker" name="txtconclusao" readonly></td>
        </tr>
        <tr>
          <td> Comentário: </td>
          <td> <textarea name="txacomentario"><?php echo $comentario ?></textarea> </td>
        </tr>
        <tr align="center">
          <td>
            <button type="reset" name="btnlimpar">Limpar</button>
          </td>
          <td>
            <button type="submit" name="btnsalvar">Salvar</button>
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
