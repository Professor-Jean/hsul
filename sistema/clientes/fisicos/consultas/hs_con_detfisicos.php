<h2>Consulta Detalhada de Cliente Físico</h2>
<div>
<form action="../adicionais/php/hs_construirpdf_php.php" id="gerarpdf" method="POST" onsubmit="return catchContent()">
  <input type="hidden" name="dadospdf" id="dadospdf" value=""> <!-- Dados para impressão -->
  <button type="submit" class="b_imprimir" id="pdf">Gerar PDF</button>
</form>
  <div class="registros">
    <?php

      $g_id = $_GET['id'];

      $hs_sel_clientesfisicos = "SELECT clientes.*, clientesfisicos.*, cidades.nome AS nome_cidade, estados.nome AS estado FROM clientesfisicos INNER JOIN clientes ON clientesfisicos.clientes_id=clientes.id  INNER JOIN cidades ON clientes.cidades_id=cidades.id INNER JOIN estados ON cidades.estados_id=estados.id WHERE clientesfisicos.id='".$g_id."'";
      $hs_sel_clientesfisicos_preparado = $conexaobd->prepare($hs_sel_clientesfisicos);
      $hs_sel_clientesfisicos_preparado->execute();

      if ($hs_sel_clientesfisicos_preparado->rowCount()>0){
        $hs_sel_clientesfisicos_resultados = $hs_sel_clientesfisicos_preparado->fetch();
        $cep = preg_replace('/^(\d{2})(\d{3})(\d{3})$/', '\\1.\\2-\\3', $hs_sel_clientesfisicos_resultados['cep']);
        $telefone= preg_replace('/^(\d{2})(\d{4,5})(\d{4})$/', '($1) $2-$3', $hs_sel_clientesfisicos_resultados['telefone']);
        $cpf = preg_replace('/^(\d{3})(\d{3})(\d{3})(\d{2})$/', '$1.$2.$3-$4', $hs_sel_clientesfisicos_resultados['cpf']);
        $data = explode("-", $hs_sel_clientesfisicos_resultados['data_nascimento']);
    ?>
	<span class="imprimir">
    <table>
      <tr>
        <td>Nome do funcionário:</td>
        <td><?php echo $hs_sel_clientesfisicos_resultados['nome']?></td>
      </tr>
      <tr>
        <td>Data de nascimento:</td>
        <td><?php echo $data[2]."/".$data[1]."/".$data[0]; ?></td>
      </tr>
      <tr>
        <td>E-mail:</td>
        <td><?php echo $hs_sel_clientesfisicos_resultados['email'];?></td>
      </tr>
      <tr>
        <td>Telefone:</td>
        <td><?php echo $telefone;?></td>
      </tr>
      <tr>
        <td>CPF:</td>
        <td><?php echo $cpf;?></td>
      </tr>
      <tr>
        <td>RG:</td>
        <td><?php echo $hs_sel_clientesfisicos_resultados['bairro'];?></td>
      </tr>
      <tr>
        <td>CEP:</td>
        <td><?php echo $cep;?></td>
      </tr>
      <tr>
        <td>Estado:</td>
        <td><?php echo $hs_sel_clientesfisicos_resultados['estado'];?></td>
      </tr>
      <tr>
        <td>Cidade:</td>
        <td><?php echo $hs_sel_clientesfisicos_resultados['nome_cidade'];?></td>
      </tr>
      <tr>
        <td>Bairro:</td>
        <td><?php echo $hs_sel_clientesfisicos_resultados['bairro'];?></td>
      </tr>
      <tr>
        <td>Logradouro:</td>
        <td><?php echo $hs_sel_clientesfisicos_resultados['logradouro'];?></td>
      </tr>
      <tr>
        <td>Número da residência:</td>
        <td><?php echo $hs_sel_clientesfisicos_resultados['numero_residencia'];?></td>
      </tr>
      <tr>
        <td>Complemento:</td>
        <td><?php echo $hs_sel_clientesfisicos_resultados['complemento'];?></td>
      </tr>
      <tr>
        <td>Observações:</td>
        <td><?php echo $hs_sel_clientesfisicos_resultados['observacoes'];?></td>
      </tr>
    </table>
	</span>
  </div>
  <br />
  <span class="imprimir">
      <h3 align="center">Relatório de Compras do Cliente</h3>
    </span>
  <span class="imprimir">
  <div class="consultas" style="margin-top: -15px;">
    <?php
    $hs_sel_orcamentos = "SELECT orcamentos.data_conclusao AS conclusao, produtos.id AS codigo_produto, produtos.nome AS nome_produto, orcamentos_has_produtos.quantidade_por_produto AS quantidade FROM orcamentos INNER JOIN orcamentos_has_produtos ON orcamentos.id=orcamentos_has_produtos.orcamentos_id INNER JOIN produtos ON orcamentos_has_produtos.produtos_id=produtos.id INNER JOIN clientes ON orcamentos.clientes_id=clientes.id INNER JOIN clientesfisicos ON clientes.id=clientesfisicos.clientes_id WHERE clientesfisicos.id='".$g_id."' AND status='2'";
    $hs_sel_orcamentos_preparado = $conexaobd->prepare($hs_sel_orcamentos);
    $hs_sel_orcamentos_preparado->execute();
    ?>
    <table>
      <thead>
        <tr>
          <th>Código do Produto</th>
          <th>Nome do Produto</th>
          <th>Qtde. Total</th>
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
          <td><?php echo $data2[2]."/".$data2[1]."/".$data2[0]; ?></td>
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
  </div>
  </span>
  <?php
    }else{
      echo "Houve um erro na consulta dos dados.";
    }
  ?>
</div>
