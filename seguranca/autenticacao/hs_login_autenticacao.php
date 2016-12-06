<?php

  include "../banco_de_dados/hs_conexao_bd.php";

?>
<html lang="pt-br">
  <head>
    <title> HSUL - Conforto e Lazer </title>
		<meta charset="utf-8"/>
		<meta name="Author" content="Beatriz Loffi Wensing May, Daniele Souza, Sinthia de Freitas, Tiago Murilo Ochôa da Luz"/>
    <link rel="icon" href="layout/images/frontend/icon.png">
    <link href="../../layout/css/hsul_frontend_css.css" rel="stylesheet" type="text/css"/>
    <link href="../../layout/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
  </head>
  <body>
    <div class="corpo">
      <header>
        <img src="../../layout/imagens/frontend/logo.png" />
      </header>
      <div class="conteudo">
        <div class="tabela">
          <table>
            <tr>
              <td colspan="1"><i style="float: left; color:#f9fdff; font-size: 20px; padding-right: 5px;" class="fa fa-exclamation-circle" aria-hidden="true"></i><p style="margin-left: 5px; color:#f9fdff;">Aviso</p></td>
            </tr>
            <tr>
              <td colspan="2" style="color:#113a4e">
            <?php
            $p_usuario = $_POST['txtusuario'];
            $p_senha = $_POST['pwdsenha'];

            if($p_usuario==""){
              echo "Você não preencheu o campo 'Usuário'.";
              }else if($p_senha==""){
                echo "Você não preencheu o campo 'Senha'.";
              }else{
                $hash_senha = md5($salt.$p_senha);

                $sql_sel_usuarios = "SELECT * FROM usuarios WHERE usuario='".$p_usuario."' AND senha='".$hash_senha."'";
                $sql_sel_usuarios_preparado = $conexaobd->prepare($sql_sel_usuarios);
                $sql_sel_usuarios_preparado->execute();

                if($sql_sel_usuarios_preparado->rowCount()==1){
                  $sql_sel_usuarios_dados = $sql_sel_usuarios_preparado->fetch();

                  session_start();

                  $_SESSION['idUsuario'] = $sql_sel_usuarios_dados['id'];
                  $_SESSION['usuario'] = $sql_sel_usuarios_dados['usuario'];
                  $_SESSION['permissao'] = $sql_sel_usuarios_dados['permissao'];
                  $_SESSION['idSessao'] = session_id();

                    if($sql_sel_usuarios_dados['permissao']==0){
                          header('Location: ../../sistema/hs_menu_funcionarios.php');
                      }else if($sql_sel_usuarios_dados['permissao']==1){
                          header('Location: ../../sistema/hs_menu_funcionarios.php');
                        }else if($sql_sel_usuarios_dados['permissao']==2){
                            header('Location: ../../sistema/hs_menu_funcionarios.php');
                          }else{
                              $mensagem = "Permissão invalida!";
                          }
                      }else{
                            echo "Dados de autenticação incorretos!";
                        }
                }
            ?>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <a style="float: right;color:#f9fdff; text-decoration: none; padding: -10px;" href="../../index.php"><i style="font-size:18px; padding-right: 5px;" class="fa fa-arrow-circle-left" aria-hidden="true"></i>Voltar</a>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <footer>
      <p>© Copyright 2016 <a href="http://www.hsul.com.br">HSUL - Conforto e Lazer</a> | <a id="linkpopup">Desenvolvedores</a></p>
      <script src="../../adicionais/js/hs_desenvolvedores_js.js"></script>
    </footer>
  </body>
</html>
