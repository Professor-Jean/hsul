<h2> Registro de Estado </h2>
<div>
  <div class="registros">
    <br />
    <form name="frmcadestados" method="post" action="?pasta=localidades/estados/&arq=hs_ins_estados&ext=php" onsubmit="return validacaoestados()">
      <table>
        <tr>
          <td> Nome do estado: </td>
          <td> <input type="text" name="txtnome" maxlength="20"/> </td>
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

$hs_sel_estados = "SELECT * FROM estados";
$hs_sel_estados_preparado = $conexaobd->prepare($hs_sel_estados);
$hs_sel_estados_preparado->execute();

?>
<div class="consultas">
  <table>
    <thead>
      <tr>
        <th width="70%">Nome</th>
        <th width="15%">Editar</th>
        <th width="15%">Excluir</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if($hs_sel_estados_preparado->rowCount() > 0){
        while($hs_sel_estados_dados = $hs_sel_estados_preparado->fetch()){
      ?>
      <tr>
        <td><?php echo $hs_sel_estados_dados['nome']; ?></td>
        <td align="center"><a href="?pasta=localidades/estados/&arq=hs_fmupd_estados&ext=php&id=<?php echo $hs_sel_estados_dados['id'];?>" title="Editar cidade"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
        <td align="center"><a title="Excluir registro"><?php echo confirmacao_exclusao($hs_sel_estados_dados['id'], 'vazio', '?pasta=localidades/estados/&arq=hs_del_estados&ext=php', 'o estado',  $hs_sel_estados_dados['nome']); ?></a></td>
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
