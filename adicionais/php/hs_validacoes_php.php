<?php
//validação e-mail

function validacaoemail($email){ //recebendo o que o usuario escreveu

  return filter_var($email, FILTER_VALIDATE_EMAIL); //verificando se o e-mail bate com a função  para validar e-mail
}

//validação de telefone

function validacaotelefone($n_usuario, $min, $max){ //função recebendo minimo de numeros para se digitar, máximo, e o numero digitado pelo usuario

$string = "/^([0-9]{{$min},{$max}})$/"; //fazendo expressão regular

  if(!preg_match($string, $n_usuario)){ //verificando se o que o usuario digitou corresponde com a string
    return false; //se não corresponder, retorna false
  }else{ //se corresponder
    return true; //volta true.
  }
}
//validação do CNPJ

function validacaocnpj($n_usuario){ //função recebendo minimo de numeros para se digitar, máximo, e o numero digitado pelo usuario

$string = "/^([0-9]{2}[\.]?[0-9]{3}[\.]?[0-9]{3}[\/]?[0-9]{4}[-]?[0-9]{2})|([0-9]{3}[\.]?[0-9]{3}[\.]?[0-9]{3}[-]?[0-9]{2})$/"; //fazendo expressão regular

  if(!preg_match($string, $n_usuario)){ //verificando se o que o usuario digitou corresponde com a string
    return false; //se não corresponder, retorna false
  }else{ //se corresponder
    return true; //volta true.
    }
  }

//validação CEP
function validacaocep($n_usuario){ //função recebendo minimo de numeros para se digitar, máximo, e o numero digitado pelo usuario

$string = "/^[0-9]{2}\.[0-9]{3}\-[0-9]{3}$/"; //fazendo expressão regular

  if(!preg_match($string, $n_usuario)){ //verificando se o que o usuario digitou corresponde com a string
    return false; //se não corresponder, retorna false
  }else{ //se corresponder
    return true; //volta true.
    }
  }

  //validação numero da empresa
  // function validacaonumero($n_usuario){ //função recebendo minimo de numeros para se digitar, máximo, e o numero digitado pelo usuario
  //
  // $string = "/^[1-9]?[0-9]{4}$/"; //fazendo expressão regular
  //
  //   if(!preg_match($string, $n_usuario)){ //verificando se o que o usuario digitou corresponde com a string
  //     return false; //se não corresponder, retorna false
  //   }else{ //se corresponder
  //     return true; //volta true.
  //     }
  //   }
  //validação CPF
  function validacaocpf($n_usuario){ //função recebendo minimo de numeros para se digitar, máximo, e o numero digitado pelo usuario

  $string = "/^[0-9]{3}.?[0-9]{3}.?[0-9]{3}-?[0-9]{2}/"; //fazendo expressão regular

    if(!preg_match($string, $n_usuario)){ //verificando se o que o usuario digitou corresponde com a string
      return false; //se não corresponder, retorna false
    }else{ //se corresponder
      return true; //volta true.
      }
    }

    function validarnumero($var){
      if(!is_numeric($var)){
      $var = 0;
      }
      return $var;
      }

?>
