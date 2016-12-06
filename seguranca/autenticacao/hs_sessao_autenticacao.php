<?php

 session_start(); //inicio da sessão

 if(!isset($_SESSION['idSessao'])){ //verifica se a sessão tem id na sessao, se nao tiver sai automaticamente
    header("Location: ".BASE_URL."seguranca/autenticacao/hs_logout_autenticacao.php");
    exit;
  }else if($_SESSION['idSessao']!=session_id()){ //verifica se a sessão não tem id correspondente, se nao tiver sai automaticamente
      header("Location: ".BASE_URL."seguranca/autenticacao/hs_logout_autenticacao.php");
      exit;
    }

?>
