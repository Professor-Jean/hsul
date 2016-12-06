 <?php
  function confirmacao_exclusao($valor, $valor2, $acao, $tipo, $nome){
    //criando um nomde de formulário único
    $formName = md5($valor.time());

    //criptgrafando o valor para complicar o acesso ao usuário
    $criptoValor = md5($valor);

    $submit = "onClick = 'confirmar_exclusao(\"$tipo\", \"$nome\", \"$formName\" );'";

  if($valor2=="vazio"){
    //iniciando link seguro com a criação do formulário.
    $safeLink = "<form name='".$formName."' action='".$acao."' method='POST' id='".$formName."'>";
    //incrementando o campo hidden que conterá o valor do registro que será excluído
    $safeLink.= "<input type='hidden' name='id' value='".$criptoValor."'/>";
    //incrementando o elemento que acionará o o formulário com a imagem de delete
    $safeLink.= "<i $submit class='fa fa-trash' aria-hidden='true'></i>";
    //fechando o formulário.
    $safeLink.= "</form>";
  }else{
    $criptoValor2 = md5($valor2);

    //iniciando link seguro com a criação do formulário.
    $safeLink = "<form name='".$formName."' action='".$acao."' method='POST' id='".$formName."'>";
    //incrementando o campo hidden que conterá o valor do registro que será excluído
    $safeLink.= "<input type='hidden' name='id' value='".$criptoValor."'/>";
    //incrementando o campo hidden que conterá o valor do registro que será excluído
    $safeLink.= "<input type='hidden' name='id2' value='".$criptoValor2."'/>";
    //incrementando o elemento que acionará o o formulário com a imagem de delete
    $safeLink.= "<i $submit class='fa fa-trash' aria-hidden='true'></i>";
    //fechando o formulário.
    $safeLink.= "</form>";
    }
    //retornando formulário\
    return $safeLink;
  }
?>
