<span class="imprimir">
  <h2>Consulta Detalhada de Pessoa Jurídica</h2>
</span>
<form action="../adicionais/php/hs_construirpdf_php.php" id="gerarpdf" method="POST" onsubmit="return catchContent()">
  <input type="hidden" name="dadospdf" id="dadospdf" value=""> <!-- Dados para impressão -->
  <button type="submit" class="b_imprimir" id="pdf">Gerar PDF</button>
</form>
<div>
  <div class="registros">
    <?php
      $g_juridicos_id = $_GET['juridicos_id'];
      $g_clientes_id = $_GET['clientes_id'];

      $hs_sel_juridicos = "SELECT clientesjuridicos.*, clientes.*, cidades.nome AS cidades_nome, estados.nome AS estados_nome FROM clientesjuridicos INNER JOIN clientes ON clientesjuridicos.clientes_id=clientes.id  INNER JOIN cidades ON clientes.cidades_id=cidades.id INNER JOIN estados ON cidades.estados_id=estados.id WHERE clientesjuridicos.id='".$g_juridicos_id."'";
      $hs_sel_juridicos_preparado = $conexaobd->prepare($hs_sel_juridicos);
      $hs_sel_juridicos_preparado->execute();

      if($hs_sel_juridicos_preparado->rowCount()>0){
        $hs_sel_juridicos_dados = $hs_sel_juridicos_preparado->fetch();

        $cep = preg_replace('/^(\d{2})(\d{3})(\d{3})$/', '\\1.\\2-\\3', $hs_sel_juridicos_dados['cep']);
        $telefone_empresa = preg_replace('/^(\d{2})(\d{4,5})(\d{4})$/', '($1) $2-$3', $hs_sel_juridicos_dados['telefone_empresa']);
        $telefone_representante = preg_replace('/^(\d{2})(\d{4,5})(\d{4})$/', '($1) $2-$3', $hs_sel_juridicos_dados['telefone_representante']);
    ?>
  <span class="imprimir">
    <table>
      <tr>
        <td>Razão social:</td>
        <td><?php echo $hs_sel_juridicos_dados['razao_social'];?></td>
      </tr>
      <tr>
        <td>Nome fantasia:</td>
        <td><?php echo $hs_sel_juridicos_dados['nome'];?></td>
      </tr>
      <tr>
        <td>Atividade principal:</td>
        <td><?php echo $hs_sel_juridicos_dados['atividade_principal'];?></td>
      </tr>
      <tr>
        <td>Telefone da empresa:</td>
        <td><?php echo $telefone_empresa; ?></td>
      </tr>
      <tr>
        <td>E-mail da empresa:</td>
        <td><?php echo $hs_sel_juridicos_dados['email_empresa']; ?></td>
      </tr>
      <tr>
        <td>CNPJ:</td>
        <td><?php echo $hs_sel_juridicos_dados['cnpj'];?></td>
      </tr>
      <tr>
        <td>CEP:</td>
        <td><?php echo $cep; ?></td>
      </tr>
      <tr>
        <td>Estado:</td>
        <td><?php echo $hs_sel_juridicos_dados['estados_nome'];?></td>
      </tr>
      <tr>
        <td>Cidade:</td>
        <td><?php echo $hs_sel_juridicos_dados['cidades_nome'];?></td>
      </tr>
      <tr>
        <td>Bairro:</td>
        <td><?php echo $hs_sel_juridicos_dados['bairro'];?></td>
      </tr>
      <tr>
        <td>Logradouro:</td>
        <td><?php echo $hs_sel_juridicos_dados['logradouro'];?></td>
      </tr>
      <tr>
        <td>Número da empresa:</td>
        <td><?php echo $hs_sel_juridicos_dados['numero_empresa'];?></td>
      </tr>
      <tr>
        <td>Complemento:</td>
        <td><?php echo $hs_sel_juridicos_dados['complemento'];?></td>
      </tr>
      <tr>
        <td>Nome do representante:</td>
        <td><?php echo $hs_sel_juridicos_dados['nome_representante'];?></td>
      </tr>
      <tr>
        <td>Telefone do representante:</td>
        <td><?php echo $telefone_representante;?></td>
      </tr>
      <tr>
        <td>Observações:</td>
        <td><?php echo $hs_sel_juridicos_dados['observacoes'];?></td>
      </tr>
    </table>
  </span>
  </div>
    <div class="consultas">
      <br />
      <span class="imprimir">
      <h3 align="center">Relatório de Compras do Cliente</h3>
    </span>
    <span class="imprimir">
      <div class="consultas" style="margin-top: -15px;">
      <table>
        <?php
        $hs_sel_orcamentos = "SELECT orcamentos.data_conclusao AS conclusao, produtos.id AS codigo_produto, produtos.nome AS nome_produto, orcamentos_has_produtos.quantidade_por_produto AS quantidade FROM orcamentos INNER JOIN orcamentos_has_produtos ON orcamentos.id=orcamentos_has_produtos.orcamentos_id INNER JOIN produtos ON orcamentos_has_produtos.produtos_id=produtos.id INNER JOIN clientes ON orcamentos.clientes_id=clientes.id INNER JOIN clientesjuridicos ON clientes.id=clientesjuridicos.clientes_id WHERE clientesjuridicos.clientes_id='".$g_clientes_id."' AND status='2'";
        $hs_sel_orcamentos_preparado = $conexaobd->prepare($hs_sel_orcamentos);
        $hs_sel_orcamentos_preparado->execute();
        //echo $hs_sel_orcamentos;
        ?>
        <thead>
          <tr>
            <th>Código do produto</th>
            <th>Nome do produto</th>
            <th>Quantidade total</th>
            <th>Data</th>
          </tr>
        </thead>
        <tbody>
          <?php
            if($hs_sel_orcamentos_preparado->rowCount() > 0){
              while($hs_sel_orcamentos_dados = $hs_sel_orcamentos_preparado->fetch()){
                $data2 = explode("-", $hs_sel_orcamentos_dados['conclusao']);
          ?>
          <tr>
            <td><?php echo $hs_sel_orcamentos_dados['codigo_produto']; ?></td>
            <td><?php echo $hs_sel_orcamentos_dados['nome_produto']; ?></td>
            <td><?php echo $hs_sel_orcamentos_dados['quantidade']; ?></td>
            <td><?php echo $data2[2]."/".$data2[1]."/".$data2[0];  ?></td>
          </tr>
          <?php
            }
            }else{//fechando a estrutura de repetiçÃo
          ?>
          <tr>
            <td align="center" colspan="4">Não há registros</td>
          </tr>
          <?php
            }
          ?>
        </tbody>
      </table>
      </span>
    </div>
    <?php
      }else{
        echo "Houve um erro na consulta dos dados.";
      }
    ?>
  </div>
</div>
