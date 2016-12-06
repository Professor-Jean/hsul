<h2> Consulta Detalhada de Orçamento </h2>
<form action="../adicionais/php/hs_construirpdf_php.php" id="gearpdf" method="POST" onsubmit="return catchContent()">
  <input type="hidden" name="dadospdf" id="dadospdf" value="">
  <button type="submit" id="pdf">Gerar PDF</button>
</form>
  <div class="consultas_orc">
    <?php
      $g_id = $_GET['id'];

      $hs_sel_orcamentos = "SELECT orcamentos.*, estados.nome AS estado, cidades.nome AS cidade, funcionarios.nome_completo, clientes.nome  FROM orcamentos INNER JOIN cidades ON cidades.id=orcamentos.cidades_id INNER JOIN estados ON estados.id=cidades.estados_id INNER JOIN funcionarios ON funcionarios.id=orcamentos.funcionarios_id INNER JOIN clientes ON  clientes.id=orcamentos.clientes_id WHERE orcamentos.id='".$g_id."'";
      $hs_sel_orcamentos_preparado = $conexaobd->prepare($hs_sel_orcamentos);
      $hs_sel_orcamentos_preparado->execute();

      if($hs_sel_orcamentos_preparado->rowCount()>0){
        $hs_sel_orcamentos_dados = $hs_sel_orcamentos_preparado->fetch();

        switch ($hs_sel_orcamentos_dados['status']){
          case 0:
            $status = "Pendente";
            break;
          case 1:
            $status = "Aprovado";
            break;
          case 2:
            $status = "Concluído";
            break;
          case 3:
            $status = "Declinado";
            break;
          default:
            $status = "Inválido";
        }

        $data_validade = explode("-",  $hs_sel_orcamentos_dados['data_validade']);

        $cep = preg_replace('/^(\d{2})(\d{3})(\d{3})$/', '\\1.\\2-\\3', $hs_sel_orcamentos_dados['cep']);


    ?>
    <table class="orc_table">
      <tr>
        <td> Funcionário responsável: </td>
        <td> <?php echo $hs_sel_orcamentos_dados['nome_completo']; ?> </td>
      </tr>
      <tr>
    </table>
    <span class="imprimir">
    <table class="orc_table">
        <td> Código do orçamento: </td>
        <td> <?php echo $hs_sel_orcamentos_dados['id']; ?> </td>
      </tr>
      <tr>
        <td> Nome do Cliente: </td>
        <td> <?php echo $hs_sel_orcamentos_dados['nome']; ?> </td>
      </tr>
      <tr>
        <td colspan="2">
          <div class="mestre_detalhes_con">
            <h5>Produtos</h5>
            <table  class="produtos_lista">
              <tr>
                <th><h4>Código do produto:</h4></th>
                <th><h4>Nome do produto:</h4></th>
                <th><h4>Marca:</h4></th>
                <th><h4>Quantidade:</h4></th>
                <th><h4>Valor total:</h4></th>
              </tr>
              <?php
                $hs_sel_produtos = "SELECT produtos.nome, produtos.id, categorias.nome AS categoria, marcas.nome AS marca, orcamentos_has_produtos.quantidade_por_produto, orcamentos_has_produtos.valor_por_produto FROM orcamentos_has_produtos INNER JOIN orcamentos ON orcamentos_has_produtos.orcamentos_id=orcamentos.id INNER JOIN produtos ON orcamentos_has_produtos.produtos_id=produtos.id INNER JOIN marcas ON produtos.marcas_id=marcas.id INNER JOIN categorias ON produtos.categorias_id=categorias.id WHERE orcamentos_has_produtos.orcamentos_id='".$g_id."' AND produtos.produtos_diversos='2'";
                $hs_sel_produtos_preparado = $conexaobd->prepare($hs_sel_produtos);
                $hs_sel_produtos_preparado->execute();

                $valor_produtos = 0;

                while($hs_sel_produtos_dados = $hs_sel_produtos_preparado->fetch()){
                  $valor = $hs_sel_produtos_dados['valor_por_produto']*$hs_sel_produtos_dados['quantidade_por_produto'];
                  $valortotal = number_format($valor, 2, ',', '');
              ?>
              <tr>
                <td> <?php echo $hs_sel_produtos_dados['id'];?> </td>
                <td class="produtos"> <?php echo $hs_sel_produtos_dados['nome'];?></td>
                <td> <?php echo $hs_sel_produtos_dados['marca'];?> </td>
                <td> <?php echo $hs_sel_produtos_dados['quantidade_por_produto'];?> </td>
                <td> <?php echo "R$ ".$valortotal; ?></td>
              </tr>
              <?php
                  $valor_produtos = $valor_produtos +  ($hs_sel_produtos_dados['valor_por_produto']*$hs_sel_produtos_dados['quantidade_por_produto']);
                }
              ?>
            </table>
          </div>
        </td>
      </tr>
      <?php
        $hs_sel_produtosd = "SELECT produtos.nome, produtos.id, categorias.nome AS categoria, marcas.nome AS marca, orcamentos_has_produtos.quantidade_por_produto, orcamentos_has_produtos.valor_por_produto FROM orcamentos_has_produtos INNER JOIN orcamentos ON orcamentos_has_produtos.orcamentos_id=orcamentos.id INNER JOIN produtos ON orcamentos_has_produtos.produtos_id=produtos.id INNER JOIN marcas ON produtos.marcas_id=marcas.id INNER JOIN categorias ON produtos.categorias_id=categorias.id WHERE orcamentos_has_produtos.orcamentos_id='".$g_id."' AND produtos.produtos_diversos='1'";
        $hs_sel_produtosd_preparado = $conexaobd->prepare($hs_sel_produtosd);
        $hs_sel_produtosd_preparado->execute();

        $valor_diversos = 0;

        if($hs_sel_produtosd_preparado->rowCount()>0){
      ?>
              <tr>
                <td colspan="2">
                  <div class="mestre_detalhes_con">
                    <h5>Produtos Diversos:</h5>
                    <table  class="produtos_lista">
                      <tr>
                        <th><h4>Código do produto:</h4></th>
                        <th><h4>Nome do produto:</h4></th>
                        <th><h4>Marca:</h4></th>
                        <th><h4>Quantidade:</h4></th>
                        <th><h4>Valor total:</h4></th>
                      </tr>
      <?php
        while($hs_sel_produtosd_dados = $hs_sel_produtosd_preparado->fetch()){

          $valor = $hs_sel_produtosd_dados['valor_por_produto']*$hs_sel_produtosd_dados['quantidade_por_produto'];
          $valortotal = number_format($valor, 2, ',', '');
        ?>
              <tr>
                <td> <?php echo $hs_sel_produtosd_dados['id'];?> </td>
                <td class="produtos"> <?php echo $hs_sel_produtosd_dados['nome'];?></td>
                <td> <?php echo $hs_sel_produtosd_dados['marca'];?> </td>
                <td> <?php echo $hs_sel_produtosd_dados['quantidade_por_produto'];?> </td>
                <td> <?php echo "R$ ".$valortotal; ?></td>
              </tr>
              <?php
                    $valor_diversos = $valor_diversos + ($hs_sel_produtosd_dados['valor_por_produto']*$hs_sel_produtosd_dados['quantidade_por_produto']);
                  }
              ?>
            </table>
          </div>
        </td>
      </tr>
              <?php
                }

        $total_produtos = $valor_produtos+$valor_diversos;
        $total          = $total_produtos+$hs_sel_orcamentos_dados['valor_mao_de_obra'];
        $desconto       = $hs_sel_orcamentos_dados['desconto']/100*$total;
        $fechado        = $total-$desconto;

        $valor_totalprodutos  = number_format($total_produtos, 2, ',', ' ');
        $valor_maodeobra      = number_format($hs_sel_orcamentos_dados['valor_mao_de_obra'], 2, ',', ' ');
        $valor_total          = number_format($total, 2, ',', '');
        $valor_fechado        = number_format($fechado, 2, ',', '');

        $desconto = number_format($hs_sel_orcamentos_dados['desconto'], 2, ',', '');
      ?>
      <tr>
        <td> Valor total produtos: </td>
        <td> <?php echo "R$ ".$valor_totalprodutos; ?> </td>
      </tr>
      <tr>
        <td> Valor da mão de obra: </td>
        <td> <?php echo "R$ ".$valor_maodeobra; ?> </td>
      </tr>
      <tr>
        <td> Valor total: </td>
        <td> <?php echo "R$ ".$valor_total; ?> </td>
      </tr>
      <tr>
        <td> Desconto: </td>
        <td> <?php echo floatval($desconto)."%" ;?> </td>
      </tr>
      <tr>
        <td> Valor fechado: </td>
        <td> <?php echo "R$ ".$valor_fechado; ?> </td>
      </tr>
      <?php
        if(isset($hs_sel_orcamentos_dados['descricao'])){
      ?>
      <tr>
        <td> Descrição: </td>
        <td> <?php echo $hs_sel_orcamentos_dados['descricao']; ?> </td>
      </tr>
      <?php
        }
      ?>
      <tr>
        <td> CEP: </td>
        <td> <?php echo $cep; ?> </td>
      </tr>
      <tr>
        <td> Estado: </td>
        <td> <?php echo $hs_sel_orcamentos_dados['estado']; ?> </td>
      </tr>
      <tr>
        <td> Cidade: </td>
        <td> <?php echo $hs_sel_orcamentos_dados['cidade']; ?> </td>
      </tr>
      <tr>
        <td> Bairro: </td>
        <td> <?php echo $hs_sel_orcamentos_dados['bairro']; ?> </td>
      </tr>
      <tr>
        <td> Logradouro: </td>
        <td> <?php echo $hs_sel_orcamentos_dados['logradouro']; ?> </td>
      </tr>
      <tr>
        <td> Número da residência: </td>
        <td> <?php echo $hs_sel_orcamentos_dados['numero_residencia']; ?> </td>
      </tr>
      <tr>
        <td> Complemento: </td>
        <td> <?php echo $hs_sel_orcamentos_dados['complemento']; ?> </td>
      </tr>
      <tr>
        <td> Validade do Orçamento: </td>
        <td> <?php echo  $data_validade[2]."/".$data_validade[1]."/".$data_validade[0]; ?> </td>
      </tr>
    </table>
    </span>
    <table class="orc_table">
      <?php
        if(isset($hs_sel_orcamentos_dados['motivo'])){
      ?>
      <tr>
        <td> Motivo: </td>
        <td> <?php echo $hs_sel_orcamentos_dados['motivo']; ?> </td>
      </tr>
      <?php
        }
      ?>
      <tr>
        <td> Status: </td>
          <td> <?php echo $status; ?> </td>
      </tr>
    </table>
    <?php
      }else{
        echo "Houve um erro na consulta dos dados.";
      }
    ?>
  </div>
