<?php

  $server_name = $_SERVER['SERVER_NAME']; //variavel criada que serve para pegar a variavel server que ja tem no php
  $project_name = "hsul_btds"; //variavel criada para identificar o nome do arquivo

  define("BASE_URL", "http://".$server_name.DIRECTORY_SEPARATOR.$project_name.DIRECTORY_SEPARATOR); //constante, deixa como padrao o começo de todos os links das paginas.
  include "autenticacao/hs_sessao_autenticacao.php"; //inclui a autenticação da sessão

?>
