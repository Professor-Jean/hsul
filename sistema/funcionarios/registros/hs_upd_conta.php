<?php
  $p_id         = $_POST['hidid'];
  $p_usuario    = $_POST['txtusuario'];
  $p_email      = $_POST['txtemail'];
  $p_senha      = $_POST['pwdsenha'];

  if($p_email==""){
    $msg = mensagensadm(1, 'E-mail');
    }else if($p_senha==""){
      $msg = mensagensadm(1, 'Senha');
    }else{
      $sql_sel_usuario = "SELECT usuarios.*, funcionarios.email FROM usuarios INNER JOIN funcionarios ON funcionarios.usuarios_id=usuarios.id WHERE funcionarios.email='".$p_email."' AND usuarios.id<>'".$p_id."'";
      $sql_sel_usuarios_preparado = $conexaobd->prepare($sql_sel_usuario);
      $sql_sel_usuarios_preparado->execute();

      if($sql_sel_usuarios_preparado->rowCount()==0){

        $tabela = "funcionarios";

        $dados = array(
          'email'  => $p_email,
        );

        $condicao = "usuarios_id='".$p_id."'";

        $hs_upd_funcionarios_resultado = alterar($tabela, $dados, $condicao);

        $hash_senha = md5($salt.$p_senha);

        $tabela = "usuarios";

        $dados = array(
          'usuario'  => $p_usuario,
          'senha'  => $hash_senha
        );

        $condicao = "id='".$p_id."'";

        $hs_upd_usuarios_resultado = alterar($tabela, $dados, $condicao);

        if($hs_upd_funcionarios_resultado&&$hs_upd_usuarios_resultado){
          $msg = mensagensadm(6, 'usuário', 'de');
        }else{
          $msg = mensagensadm(2, 'usuário');
        }
      }else{
        $msg = mensagensadm(9, 'usuário');
      }
    }
?>

<section>
  <div class="mensagem">
    <h3><i class="fa fa-exclamation-circle" aria-hidden="true"></i></i>Aviso</h3>
    <p><?php echo $msg;?></p>
    <a href="?pasta=funcionarios/registros/&arq=hs_fmupd_conta&ext=php">Voltar</a>
  </div>
</section>
