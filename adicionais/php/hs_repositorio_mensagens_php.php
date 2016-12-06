<?php

  function mensagensadm($id, $nome=NULL, $de=NULL){
    $mensagem = "";

    switch($id){
      case 1:{
        $mensagem = "Preencha o campo ".$nome.", por favor.";
      }
      break;
      case 2:{
        $mensagem = "Erro ao alterar o cadastro de ".$nome.".";
      }
      break;
      case 3:{
        $mensagem = "Cadastro efetuado com sucesso!";
      }
      break;
      case 6:{
        $mensagem = "Cadastro ".$de." ".$nome." alterado com sucesso!";
      }
      break;
      case 7:{
        $mensagem = $de." ".$nome." já existe.";
      }
      break;
      case 8:{
        $mensagem = "Erro ao cadastrar ".$de." ".$nome.".";
      }
      break;
      case 9:{
        $mensagem = $nome." inexistente";
      }
      break;
      case 10:{
        $mensagem = "Cadastro ".$de." ".$nome." excluído com sucesso!";
      }
      break;
      case 11:{
        $mensagem = "Erro ao efetuar a exclusão ".$de." ".$nome."!";
      }
      break;
      case 12:{
        $mensagem = $de." ".$nome." tem ligações com outros registros!";
      }
      break;
      case 13:{
        $mensagem = "Esse registro não pode ser excluído, pois há ligações com ".$nome.".";
      }
      break;
      case 14:{
        $mensagem = "Saida de estoque efetuada com sucesso.";
      }
      break;
      case 15:{
        $mensagem = $nome."inválido.";
      }
      break;
      case 16:{
        $mensagem = $nome." invalido(a) ou inexistente.";
      }
      break;
      case 17:{
        $mensagem = "Esse campo aceita apenas números.";
      }
      break;
      case 18:{
        $mensagem = "Quantidade solicitada está indisponível no estoque.";
      }
      break;
      case 19:{
        $mensagem = $nome." não podem ser iguais.";
      }
    }
    return $mensagem;
}
?>
