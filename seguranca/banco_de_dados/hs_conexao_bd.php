<?php
  include "hs_configuracao_bd.php";

  try{
    $conexaobd = new PDO("mysql:host=".$servidor.";dbname=".$banco.";charset=utf8", $usuario, $senha);
  } catch (PDOException $e) {
    die('Erro ao se conectar com o banco de dados: '.$e->getMessage());
  }
?>
