<?php
//Recebendo valores dos campos do formulário//
$p_id = $_POST['hidid'];
$p_categoria = $_POST['selcategoria'];
$p_marca = $_POST['selmarca'];
$p_nome = $_POST['txtnome'];
$p_minima = $_POST['txtminima'];
$p_descricao = $_POST['txadescricao'];
$caminho = "?pasta=produtos/registros/&arq=hs_fmupd_produtos&ext=php&id=".$p_id;

if($p_categoria==""){
$mensagem2 = mensagensadm(1, 'Categoria');
}else if($p_marca==""){
      $mensagem2 = mensagensadm(1, 'Marca');
    }else if($p_nome==""){
          $mensagem2 = mensagensadm(1, 'Nome');
        }else if($p_minima==""){
              $mensagem2 = mensagensadm(1, 'Quantidade Miníma');
            }else if(!validarnumero($p_minima)){
                  $mensagem2 = mensagensadm(17);
                }else{

                  $hs_sel_produtos = "SELECT categorias.nome AS categorias, marcas.nome AS marcas, produtos.nome AS produto_nome, produtos.imagem, produtos.id, produtos.quantidade_minima AS minima, produtos.descricao FROM produtos INNER JOIN categorias ON produtos.categorias_id=categorias.id INNER JOIN marcas ON produtos.marcas_id=marcas.id WHERE produtos.nome='".$p_nome."'";

                  $hs_sel_produtos_preparado = $conexaobd->prepare($hs_sel_produtos);

                if (($_FILES['flimage']['name'])==""){

                  if($hs_sel_produtos_preparado->rowCount()==0){

                    $tabela = "produtos";

                    $dados = array(
                      'categorias_id'         => $p_categoria,
                      'marcas_id'             => $p_marca,
                      'nome'                  => $p_nome,
                      'quantidade_minima'     => $p_minima,
                      'descricao'             => $p_descricao
                    );

                    $condicao = "id= '".$p_id."'";
                    $hs_upd_produtos_resultado = alterar($tabela, $dados, $condicao);

                    if($hs_upd_produtos_resultado){
                      $mensagem2 = mensagensadm(6,'produto', 'de');
                      $caminho = "?pasta=produtos/registros/&arq=hs_fmins_produtos&ext=php";
                    }else{
                      $mensagem2 = mensagensadm(2, 'produto');
                    }
                  }else{
                     $mensagem2 = mensagensadm(7, 'produto', 'Esse');
                  }
                }else{
                  $enviar_diretorio      = "../adicionais/produtos_imagens/";

                  $enviar_nome_arquivo   = criptografiaNomeImg($_FILES['flimage']['name']);

                  $enviar_arquivo       = $enviar_diretorio.$enviar_nome_arquivo;

                  $validacao_ext = array('image/jpeg', 'image/png');

                  if(in_array($_FILES['flimage']['type'], $validacao_ext)){
                    //move um arquivo que foi enviado para o servidor//
                    if (move_uploaded_file($_FILES['flimage']['tmp_name'], $enviar_arquivo)){

                      if($hs_sel_produtos_preparado->rowCount()==0){

                        $tabela = "produtos";

                        $dados = array(
                          'categorias_id'         => $p_categoria,
                          'marcas_id'             => $p_marca,
                          'nome'                  => $p_nome,
                          'imagem'                => $enviar_nome_arquivo,
                          'quantidade_minima'     => $p_minima,
                          'descricao'             => $p_descricao
                        );

                        $condicao = "id= '".$p_id."'";
                        $hs_upd_produtos_resultado = alterar($tabela, $dados, $condicao);

                        if($hs_upd_produtos_resultado){
                          $mensagem2 = mensagensadm(6,'produto', 'de');
                          $caminho = "?pasta=produtos/registros/&arq=hs_fmins_produtos&ext=php";
                        }else{
                          $mensagem2 = mensagensadm(2, 'produto');
                        }
                      }else{
                         $mensagem2 = mensagensadm(7, 'produto', 'Esse');
                         unlink($enviar_arquivo);
                      }
                    }
                  }
                }
              }
                ?>
                <section>
                  <div class="mensagem">
                    <h3><i class="fa fa-exclamation-circle" aria-hidden="true"></i></i>Aviso</h3>
                    <p><?php echo $mensagem2;?></p>
                    <a href="<?php echo $caminho;?>">Voltar</a>
                  </div>
                </section>
