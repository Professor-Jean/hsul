<h2>Consulta Detalhada de Funcionário</h2>
<div>
  <div class="registros">
    <?php
      $g_funcionarios = $_GET['funcionarios_id'];
      $g_usuarios     = $_GET['usuarios_id'];

      $hs_sel_funcionarios = "SELECT funcionarios.*, usuarios.*, cidades.nome, estados.nome AS estado FROM funcionarios INNER JOIN usuarios ON funcionarios.usuarios_id=usuarios.id  INNER JOIN cidades ON funcionarios.cidades_id=cidades.id INNER JOIN estados ON cidades.estados_id=estados.id WHERE funcionarios.id='".$g_funcionarios."' AND funcionarios.usuarios_id='".$g_usuarios."'";
      $hs_sel_funcionarios_preparado = $conexaobd->prepare($hs_sel_funcionarios);
      $hs_sel_funcionarios_preparado->execute();

      if ($hs_sel_funcionarios_preparado->rowCount()>0){
        $hs_sel_funcionarios_dados = $hs_sel_funcionarios_preparado->fetch();
        if ((($g_usuarios=='000001')&&($hs_sel_funcionarios_dados['usuarios_id']=='000001'))&&$_SESSION['idUsuario']<>'000001'){
          echo "Você não tem permissão para visualizar esta página.";
        }else{

        $cep = preg_replace('/^(\d{2})(\d{3})(\d{3})$/', '\\1.\\2-\\3', $hs_sel_funcionarios_dados['cep']);
        $cpf = preg_replace('/^(\d{3})(\d{3})(\d{3})(\d{2})$/', '$1.$2.$3-$4', $hs_sel_funcionarios_dados['cpf']);
        $telefone = preg_replace('/^(\d{2})(\d{4,5})(\d{4})$/', '($1) $2-$3', $hs_sel_funcionarios_dados['telefone']);

        $data = explode("-", $hs_sel_funcionarios_dados['data_nascimento']);
    ?>
    <table>
      <tr>
        <td>Nome do funcionário:</td>
        <td><?php echo $hs_sel_funcionarios_dados['nome_completo']?></td>
      </tr>
      <tr>
        <td>CPF:</td>
        <td><?php echo $cpf ?></td>
      </tr>
      <tr>
        <td>RG:</td>
        <td><?php echo $hs_sel_funcionarios_dados['rg']?></td>
      </tr>
      <tr>
        <td>Data de nascimento:</td>
        <td><?php echo $data[2]."/".$data[1]."/".$data[0] ?></td>
      </tr>
      <tr>
        <td>CEP:</td>
        <td><?php echo $cep ?></td>
      </tr>
      <tr>
        <td>Estado:</td>
        <td><?php echo $hs_sel_funcionarios_dados['estado']?></td>
      </tr>
      <tr>
        <td>Cidade:</td>
        <td><?php echo $hs_sel_funcionarios_dados['nome']?></td>
      </tr>
      <tr>
        <td>Bairro:</td>
        <td><?php echo $hs_sel_funcionarios_dados['bairro']?></td>
      </tr>
      <tr>
        <td>Logradouro:</td>
        <td><?php echo $hs_sel_funcionarios_dados['logradouro']?></td>
      </tr>
      <tr>
        <td>Número da residência:</td>
        <td><?php echo $hs_sel_funcionarios_dados['numero_residencia']?></td>
      </tr>
      <tr>
        <td>Complemento:</td>
        <td><?php echo $hs_sel_funcionarios_dados['complemento']?></td>
      </tr>
      <tr>
        <td>Telefone:</td>
        <td><?php echo $telefone?></td>
      </tr>
      <tr>
        <td>E-mail:</td>
        <td><?php echo $hs_sel_funcionarios_dados['email']?></td>
      </tr>
      <tr>
        <td>Usuário:</td>
        <td><?php echo $hs_sel_funcionarios_dados['usuario']?></td>
      </tr>
    <?php
      if (isset($hs_sel_funcionarios_dados['observacoes'])) {
    ?>
      <tr>
        <td>Observações:</td>
        <td><?php echo $hs_sel_funcionarios_dados['observacoes'] ?></td>
      </tr>
    <?php
      }
    ?>
    </table>
    <?php
        }
      }else{
        echo "Houve um erro na consulta dos dados.";
      }
    ?>
  </div>
</div>
