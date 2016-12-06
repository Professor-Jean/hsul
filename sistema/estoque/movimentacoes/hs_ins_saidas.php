<?php
  $p_categoria = $_POST['selcategoria'];
  $p_marca = $_POST['selmarca'];
  $p_idprodutos = $_POST['selprodutos_id'];
  $p_quantidade = $_POST['txtquantidade'];
  $p_data = $_POST['txtdatasaida'];
  $p_observacao = $_POST['txaobservacao'];
  $data = explode("/", $p_data);
  $quantidade = 0;

  $hs_sel_produtos = "SELECT * FROM produtos WHERE id='".$p_idprodutos."'";
  $hs_sel_produtos_preparado = $conexaobd->prepare($hs_sel_produtos);
  $hs_sel_produtos_preparado->execute();
  $hs_sel_produtos_dados = $hs_sel_produtos_preparado->fetch();

    if($p_categoria==""){
      $msg = mensagensadm(1, 'Categoria do produto');
    }else if($p_marca==""){
        $msg = mensagensadm(1, 'Marca do produto');
      }else if($p_idprodutos==""){
          $msg = mensagensadm(1, 'Nome do produto');
        }else if($p_quantidade==""){
            $msg = mensagensadm(1, 'Quantidade');
          }else if($p_data==""){
              $msg = mensagensadm(1, 'Data de entrada');
            }else{

                $hs_sel_saidas = "SELECT produtos.quantidade_minima, estoques.id AS estoques_id, produtos.id FROM produtos INNER JOIN estoques ON estoques.produtos_id=produtos.id WHERE produtos.id='".$p_idprodutos."'";
                $hs_sel_saidas_preparado = $conexaobd->prepare($hs_sel_saidas);
                $hs_sel_saidas_preparado->execute();
                $hs_sel_saidas_dados = $hs_sel_saidas_preparado->fetch();

                $hs_sel_estoque = "SELECT * FROM estoques WHERE produtos_id='".$p_idprodutos."'";
                $hs_sel_estoque_preparado = $conexaobd->prepare($hs_sel_estoque);
                $hs_sel_estoque_preparado->execute();
                $hs_sel_estoque_dados = $hs_sel_estoque_preparado->fetch();

                $quantidade = $hs_sel_estoque_dados['quantidade'] - $p_quantidade;

                if($quantidade<$hs_sel_saidas_dados['quantidade_minima']){
                    $msg = mensagensadm(18);
                  }else{

                    if($hs_sel_saidas_preparado->rowCount()==1){

                    if($hs_sel_estoque_preparado->rowCount()==1){

                      $tabela = "estoques";

                      $dados = array(
                        'produtos_id'  => $hs_sel_estoque_dados['produtos_id'],
                        'quantidade'   => $quantidade
                      );
                      $condicao = "id='".$hs_sel_saidas_dados['estoques_id']."'";

                      $hs_upd_estoque_resultado = alterar($tabela, $dados, $condicao);

                      $tabela = "saidasestoque";

                      $dados = array(
                        'estoques_id'  => $hs_sel_saidas_dados['estoques_id'],
                        'quantidade'   => $p_quantidade,
                        'data_saida'   => $data['2']."-".$data['1']."-".$data['0'],
                        'observacoes'  => $p_observacao
                      );

                      $hs_ins_saida_resultado = adicionar($tabela, $dados);
                      if($hs_ins_saida_resultado){
                          $msg = mensagensadm(14);
                        }else{
                            $msg = mensagensadm(9, 'Produto');
                          }
                        }else{
                          $msg = mensagensadm(15, 'Produto');
                        }
                      }
                    }
                  }
?>

<section>
  <div class="mensagem">
    <h3><i class="fa fa-exclamation-circle" aria-hidden="true"></i></i>Aviso</h3>
    <p><?php echo $msg; ?></p>
    <a href="?pasta=estoque/movimentacoes/&arq=hs_fmins_saidas&ext=php">Voltar</a>
  </div>
</section>
