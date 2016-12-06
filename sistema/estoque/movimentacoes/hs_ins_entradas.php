<?php
  $p_categoria = $_POST['selcategoria'];
  $p_marca = $_POST['selmarca'];
  $p_produto = $_POST['selprodutos_id'];
  $p_quantidade = $_POST['txtquantidade'];
  $p_vcompra = $_POST['txtvalorcompra'];
  $p_data = $_POST['txtdataentrada'];
  $p_observacao = $_POST['txaobservacao'];

    if($p_categoria==""){
      $mensagem2 = mensagensadm(1, 'Categoria do produto');
    }else if($p_marca==""){
        $mensagem2 = mensagensadm(1, 'Marca do produto');
      }else if($p_produto==""){
          $mensagem2 = mensagensadm(1, 'Nome do produto');
        }else if($p_quantidade==""){
            $mensagem2 = mensagensadm(1, 'Quantidade');
          }else if($p_vcompra==""){
              $mensagem2 = mensagensadm(1, 'Valor unitário do produto');
            }else if($p_data==""){
                $mensagem2 = mensagensadm(1, 'Data de entrada');
              }else if(!validarnumero($p_quantidade)){
                  $mensagem2 = mensagensadm(17);
                }else if(!validarnumero($p_vcompra)){
                    $mensagem2 = mensagensadm(17);
                  }else{

                    $data = explode("/", $p_data);

                    $hs_sel_estoque = "SELECT produtos.id AS produtos_id, produtos.categorias_id, categorias.nome AS categorias, produtos.marcas_id, marcas.nome AS marcas, produtos.nome AS produto_nome, entradasestoque.quantidade, entradasestoque.valor_compra, entradasestoque.data_entrada, entradasestoque.observacoes FROM entradasestoque INNER JOIN produtos ON entradasestoque.produtos_id=produtos.id INNER JOIN categorias ON produtos.categorias_id=categorias.id INNER JOIN marcas ON produtos.marcas_id=marcas.id WHERE data='".$data['2']."-".$data['1']."-".$data['0']."' AND produtos_id='".$p_produto."' AND quantidade='".$p_quantidade."'";

                    $hs_sel_estoque_preparado = $conexaobd->prepare($hs_sel_estoque);

                    $hs_sel_estoque_preparado->execute();

                  if($hs_sel_estoque_preparado->rowCount()==0){

                    $tabela = "entradasestoque";

                    $dados = array(
                      'produtos_id'     => $p_produto,
                      'quantidade'      => $p_quantidade,
                      'valor_compra'    => $p_vcompra,
                      'data_entrada'    => $data['2']."-".$data['1']."-".$data['0'],
                      'observacoes'     => $p_observacao
                    );

                    $hs_ins_entrada_resultado = adicionar($tabela, $dados);

                    if($hs_ins_entrada_resultado){

                      $hs_sel_estoques = "SELECT quantidade FROM estoques WHERE produtos_id='".$p_produto."'";

                      $hs_sel_estoques_preparado = $conexaobd->prepare($hs_sel_estoques);

                      $hs_sel_estoques_preparado->execute();

                      $hs_sel_estoques_dados = $hs_sel_estoques_preparado->fetch();

                      if(isset($hs_sel_estoques_dados['quantidade'])){
                        $quantidade = $p_quantidade + $hs_sel_estoques_dados['quantidade'];

                        $tabela = "estoques";

                        $dados = array(
                          'produtos_id'     => $p_produto,
                          'quantidade'      => $quantidade
                        );

                        $condicao = "produtos_id= '".$p_produto."'";

                        $hs_ins_estoques_resultado = alterar($tabela, $dados, $condicao);
                      }else{
                        $quantidade = $p_quantidade;

                        $tabela = "estoques";

                        $dados = array(
                          'produtos_id'     => $p_produto,
                          'quantidade'      => $quantidade
                        );

                        $hs_ins_estoques_resultado = adicionar($tabela, $dados);
                      }

                        $mensagem2 = mensagensadm(3);
                      }else{
                        $mensagem2 = mensagensadm(8,'entrada', 'essa');
                      }
                    }else{
                      $mensagem2 = mensagensadm(13, 'Entrada');
                    }
                  }
        ?>

        <section>
          <div class="mensagem">
            <h3><i class="fa fa-exclamation-circle" aria-hidden="true"></i></i>Aviso</h3>
            <p><?php echo $mensagem2; ?></p>
            <a href="?pasta=estoque/movimentacoes/&arq=hs_fmins_entradas&ext=php">Voltar</a>
          </div>
        </section>
