function confirmar_exclusao(tipo, nome, form){ //função início

  var confirmar = confirm("Você tem certeza que deseja excluir "+tipo+": "+nome+"?"); //variável recebendo valor e a função de confirm, e concatenação do tipo e nome
    if(confirmar == true){ //se for verdadeiro
      document.getElementById(form).submit(); //exclui
    }else{ //se não for
      return false; //mantém
    }
}
