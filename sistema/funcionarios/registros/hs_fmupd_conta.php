<h2>Perfil do Usuário</h2>
<?php

  $id = $_SESSION['idUsuario'];

  $hs_sel_usuario = "SELECT usuarios.*, funcionarios.email FROM usuarios INNER JOIN funcionarios ON funcionarios.usuarios_id=usuarios.id WHERE usuarios.id='".$id."'";
  $hs_sel_usuarios_preparado = $conexaobd->prepare($hs_sel_usuario);
  $hs_sel_usuarios_preparado->execute();
  $hs_sel_usuarios_dados = $hs_sel_usuarios_preparado->fetch();

?>
<div>
  <div class="registros">
    <form name="frmcontafuncionario" action="?pasta=funcionarios/registros/&arq=hs_upd_conta&ext=php" method="post">
      <table>
        <input type="hidden" value="<?php echo $id ?>" name="hidid">
        <tr>
          <td> Usuário: </td>
          <td> <input type="text" name="txtusuario" readonly="readonly" value="<?php echo $hs_sel_usuarios_dados['usuario']; ?>"/></td>
        </tr>
        <tr>
          <td> E-mail: </td>
          <td> <input type="text" name="txtemail" value="<?php echo $hs_sel_usuarios_dados['email']; ?>"/> </td>
        </tr>
        <tr>
          <td> Senha: </td>
          <td> <input type="password" name="pwdsenha"/> </td>
        </tr>
        <tr align="center">
          <td>
            <button type="reset" name="btnlimpar">Limpar</button>
          </td>
          <td>
            <button type="submit" name="btnsalvar">Alterar</button>
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
