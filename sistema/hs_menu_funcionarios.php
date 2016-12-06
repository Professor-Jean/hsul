<?php
  ob_start();

  include "../seguranca/banco_de_dados/hs_conexao_bd.php";
  include "../seguranca/hs_configuracoes_seguranca.php";
  include "../seguranca/autenticacao/hs_menu_autenticacao.php";
  include "../adicionais/php/hs_operacoesbd_php.php";
  include "../adicionais/php/hs_repositorio_mensagens_php.php";
  include "../adicionais/php/imagem_crip_php.php";
  include "../adicionais/php/hs_confirmacao_delete_php.php";
  include "../adicionais/php/hs_expirarorcamento_php.php";
  include "../adicionais/php/hs_validacoes_php.php";

?>
<html>
  <head>
    <title> HSUL - Conforto e Lazer </title>
    <meta charset="utf-8"/>
    <meta name="Author" content="Beatriz Loffi Wensing May, Daniele Souza, Sinthia de Freitas, Tiago Murilo Ochôa da Luz"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../layout/images/frontend/icon.png">
    <link href="../layout/css/hsul_backend_css.css" rel="stylesheet" type="text/css"/>
    <link href="../layout/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="../layout/css/jquery-ui.min.css" rel="stylesheet"/>
    <script type="text/javascript" src="../adicionais/js/jquery.js"></script>
    <script type="text/javascript" src="../adicionais/js/jquery-ui.min.js"> </script>
    <script type="text/javascript" src="../adicionais/js/hs_datepicker-pt-BR_js.js"> </script>
    <script type="text/javascript" src="../adicionais/js/hs_ajudantes_js.js"> </script>
    <script type="text/javascript" src="../adicionais/js/hs_confirmar_exclusao_js.js"> </script>
	<script type="text/javascript" src="../adicionais/js/hs_mestredetalhe_js.js"> </script>
	<script type="text/javascript" src="../adicionais/js/hs_validacao_formularios.js"> </script>
    <script src="../adicionais/js/hs_validacao_formularios.js"></script>
    <script>
      $(function(){
        $( "#datepicker" ).datepicker({
          changeMonth:  true,
          changeYear:   true
        });
      });
    </script>
  </head>
  <body>
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
    <div class="cabecalho"><!--COMEÇO DO CABEÇALHO
  --><header>
          <div class="logout">
            <table class="tablelougout">
              <tr>
                <td align="center"><a href="?pasta=funcionarios/registros/&arq=hs_fmupd_conta&ext=php"><?php echo $_SESSION['usuario']?></a></td>
              </tr>
              <tr>
                <td><a href="../seguranca/autenticacao/hs_logout_autenticacao.php"><button class="btnlogout">Sair</button></a></td>
              </tr>
            </table>
          </div>
          <img src="../layout/imagens/backend/logo.png" class="logo"/>
          <?php
            switch ($_SESSION['permissao']) {
              case '0':
                $funcionario = 'Administrador';
                break;
              case '1':
                $funcionario = 'Financeiro';
                break;
              case '2':
                $funcionario = '';
                break;
            }
          ?>
          <h1 class="areaacessada">Área do Funcionário <?php echo $funcionario ?></h1>
      </header>
      <nav>
        <?php
          $menu = menupermissao($_SESSION['permissao']);
          echo $menu;
        ?>
      </nav><!--
 --></div><!--FIM DO CABEÇALHO
 --><div class="conteudo">
        <?php

        if(isset($_GET['pasta'])&&isset($_GET['arq'])&&isset($_GET['ext'])){ //isset = se existir.
          if(!include $_GET['pasta'].$_GET['arq'].".".$_GET['ext']){ // se nao der certo esse include acontece..ler echo
             echo '<h1>Página não encontrada</h1>';
          }
        }else{
          ?>
          <br /><br /><br /><br />
          <div class="registros">
          <?php include "hs_inicial.php";//link para ir na pagina de "bem vindo"; ?>
          </div>
          <?php
            }
            $data_hoje = date("Y-m-d");

            $hs_sel_orcamentos = "SELECT id, comentario FROM orcamentos WHERE status='0' AND data_validade<='".$data_hoje."'";
            $hs_sel_orcamentos_preparado = $conexaobd->prepare($hs_sel_orcamentos);
            $hs_sel_orcamentos_preparado->execute();

            if($hs_sel_orcamentos_preparado->rowCount()>0){
              while($hs_sel_orcamentos_dados = $hs_sel_orcamentos_preparado->fetch()){

                $tabela = "orcamentos";

                $dados = array(
                  'motivo'      => 'NR',
                  'status'      => 3,
                  'comentario'  => $hs_sel_orcamentos_dados['comentario']
                );

                $condicao = "id='".$hs_sel_orcamentos_dados['id']."'";

                $hs_upd_orcamentos_resultado = alterar($tabela, $dados, $condicao);
                }
              }
              ?>
    </div>
    <footer>
    <p>© Copyright 2016 <a href="http://www.hsul.com.br">HSUL - Conforto e Lazer</a> | <a id="linkpopup">Desenvolvedores</a></p>
    <script src="../adicionais/js/hs_desenvolvedores_js.js"></script>
  </footer> </body>
</html>
