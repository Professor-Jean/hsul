<?php
/************************************************
@autora: Beatriz Loffi Wensing May, Daniele Souza, Sinthia de Freitas e Tiago Murilo.
@descrição: arquivo de inserir, alterar e deletar.
@data: 25/10/2016
*************************************************/
function adicionar($adc_tabela, $adc_dados){//está adicionando a tabela e os dados//
  $adc_campos = array_keys($adc_dados);//Essa função pega as posições de um array e transforma em valores em um outro array.//

  $adc_n_campos = count($adc_dados);//Neste caso a variavel é igual a 3//

  $adc_sintaxe = "INSERT INTO ".$adc_tabela." (";//está inserindo o nome da tabela e o espaço//

  for($adc_aux=0; $adc_aux<$adc_n_campos; $adc_aux++){//adicionando os campos na sintaxe//
    $adc_sintaxe.= $adc_campos[$adc_aux].", ";
  }
  $adc_sintaxe = substr($adc_sintaxe, 0, -2);//retirando a virgula e o espaço//

  $adc_sintaxe.= ") VALUES (";//continuando a sintaxe//

  for($adc_aux=0; $adc_aux<$adc_n_campos; $adc_aux++){//adicionando os campos na sintaxe//
    //Se a variavel que contém o valor a ser inserido não estiver vazia, é para concatenar o valor dela no resto da sintaxe, senão é para concatenar a palavra-chave NULL//
    if($adc_dados[$adc_campos[$adc_aux]]!==""){
      $adc_sintaxe .= "'".addslashes($adc_dados[$adc_campos[$adc_aux]])."', ";
    }else{
      $adc_sintaxe .="NULL, ";
    }
  }
    $adc_sintaxe = substr($adc_sintaxe, 0, -2);//retirando a virgula e o espaço//

    $adc_sintaxe .= ")";//terminando a estrutura da sintaxe//

    global $conexaobd;//chamando a conexaobd//
    $adc_preparado = $conexaobd->prepare($adc_sintaxe);//preparando a sintaxe//
    $adc_resultado = $adc_preparado->execute();//executando a sintaxe//

    return $adc_resultado;//retornando a funçào//
}
/************************/
  function alterar($alt_tabela, $alt_dados, $alt_condicao){

    $alt_campos = array_keys($alt_dados);//Essa função pega as posições de um array e transforma em valores em um outro array.//

    $alt_n_campos = count($alt_dados);//Neste caso a variavel é igual a 3//

    $alt_sintaxe = "UPDATE ".$alt_tabela." SET ";// fazendo a sintaxe//

    for($alt_aux=0; $alt_aux<$alt_n_campos; $alt_aux++){//adicionando os campos na sintaxe//
      $alt_sintaxe .= $alt_campos[$alt_aux]."=";

      if($alt_dados[$alt_campos[$alt_aux]]!=""){
         $alt_sintaxe .= "'".addslashes($alt_dados[$alt_campos[$alt_aux]])."', ";
        }else{
          $alt_sintaxe .="NULL, ";
        }
      }
      $alt_sintaxe = substr($alt_sintaxe, 0, -2);//retirando a virgula e o espaço//

      $alt_sintaxe.= " WHERE ".$alt_condicao;//continuando a sintaxe//

      global $conexaobd;

      $alt_preparado = $conexaobd->prepare($alt_sintaxe);//preparando a sintaxe//
      $alt_resultado = $alt_preparado->execute();//executando a sintaxe//

      return $alt_resultado;// retornando o resultado//
    }

  //$adc_sintaxe = substr($adc_sintaxe, 0, -2);//retirando a virgula e o espaço//

      // campo = 'valor',
/************************/
  function deletar($del_tabela, $del_condicao){
    $del_sintaxe = "DELETE FROM ".$del_tabela." WHERE ".$del_condicao;//fazendo a sintaxe de deletar//

    global $conexaobd;//chamando a conexaobd//

    $del_preparado = $conexaobd->prepare($del_sintaxe);//preparando a sintaxe//
    $del_resultado = $del_preparado->execute();//executando a sintaxe//

    return $del_resultado;//retornando a função//
}
?>
