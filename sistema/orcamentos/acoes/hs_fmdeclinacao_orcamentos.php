<h2> Declinação de Orçamento </h2>
<div>
  <div class="registros">
    <?php
      $g_id = $_GET['id'];

      $hs_sel_orcamentos = "SELECT comentario FROM orcamentos WHERE id='".$g_id."'";
      $hs_sel_orcamentos_preparado = $conexaobd->prepare($hs_sel_orcamentos);
      $hs_sel_orcamentos_preparado->execute();
      $hs_sel_orcamentos_dados = $hs_sel_orcamentos_preparado->fetch();
      if(isset($hs_sel_orcamentos_dados['comentario'])){
        $comentario = $hs_sel_orcamentos_dados['comentario'];
      }else{
        $comentario = "";
      }
    ?>
    <form name="frmdeclinacao" action="?pasta=orcamentos/acoes/&arq=hs_declinacao_orcamentos&ext=php" method="post">
      <table>
        <input type="hidden" name="hidid" value="<?php echo $g_id ?>" />
        <tr>
          <td colspan="2" align="center">Campos com (*) são obrigatórios.</td>
        </tr>
        <tr>
          <td> *Motivo: </td>
          <td>
            <select name="selmotivo">
              <option value="">Selecione..</option>
              <option value="FI">Financeiro</option>
              <option value="OM">Oferta melhor</option>
              <option value="PA">Problemas com atendimento</option>
              <option value="PF">Problemas familiares</option>
              <option value="NR">Não houve retorno</option>
              <option value="OU">Outro</option>
            </select>
          </td>
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
