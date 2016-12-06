<?php

  include "seguranca/banco_de_dados/hs_conexao_bd.php";

?>
<html lang="pt-br">
  <head>
    <title> HSUL - Conforto e Lazer </title>
		<meta charset="utf-8"/>
		<meta name="Author" content="Beatriz Loffi Wensing May, Daniele Souza, Sinthia de Freitas, Tiago Murilo Ochôa da Luz"/>
    <link rel="icon" href="layout/images/frontend/icon.png">
    <link href="layout/css/hsul_frontend_css.css" rel="stylesheet" type="text/css"/>
  </head>
  <body>
    <div class="corpo">
      <div class="popup" id="popup"> <!-- pop-up para Desenvolvedores -->
        <div class="popup_conteudo">
          <span class="fechar">x</span>
          <p>Beatriz Loffi Wensing May (beatrizlwmay@gmail.com)</p>
          <p>Daniele Souza (dani.souza.tec1@gmail.com)</p>
          <p>Sinthia de Freitas (si.desenhos@gmail.com)</p>
          <p>Tiago Murilo Ochoa da Luz (tiagomol.murilo08@gmail.com)</p>
          <p><br /></p>
          <p>Equipe: (tcc.btds@gmail.com)</p>
        </div>
      </div>
      <header>
        <img src="layout/imagens/frontend/logo.png" />
      </header>
      <div class="conteudo">
        <div class="tabela">
          <form name="frmvalidaacesso" method="POST" action="seguranca/autenticacao/hs_login_autenticacao.php">
            <table>
              <tr>
                <td>Usuário:</td>
              </tr>
              <tr>
                <td><input type="text" name="txtusuario" /></td>
              </tr>
              <tr>
                <td>Senha:</td>
              </tr>
              <tr>
                <td><input type="password" name="pwdsenha" /></td>
              </tr>
              <tr align="right">
                <td><button type="submit" name="btnlogin"> Entrar </button></td>
              </tr>
            </table>
          </form>
        </div>
      </div>
    </div>
    <footer>
    <p>© Copyright 2016 <a href="http://www.hsul.com.br">HSUL - Conforto e Lazer</a> | <a id="linkpopup">Desenvolvedores</a></p>
    <script src="adicionais/js/hs_desenvolvedores_js.js"></script>
  </footer>
  </body>
</html>
