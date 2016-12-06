<h2>Alterar Funcionário</h2>

<script type="text/javascript">

function mostraCidades(){

  id_estado = $('#selestado').val();

  $('#selcidade').html("<option>Aguarde</option>");

  $.post("../adicionais/php/hs_buscadinamica_php.php", {id:id_estado},
  function(dados){
      $('#selcidade').html(dados);
    }
  );
}

</script>
<div>
  <div class="registros">
    <?php
      $g_funcionarios = $_GET['funcionarios_id'];
      $g_usuarios     = $_GET['usuarios_id'];

      $hs_sel_funcionarios = "SELECT funcionarios.*, usuarios.*, cidades.nome, estados.nome AS estado, estados.id AS estados_id FROM funcionarios INNER JOIN usuarios ON funcionarios.usuarios_id=usuarios.id  INNER JOIN cidades ON funcionarios.cidades_id=cidades.id INNER JOIN estados ON cidades.estados_id=estados.id WHERE funcionarios.id='".$g_funcionarios."' AND funcionarios.usuarios_id='".$g_usuarios."'";
      $hs_sel_funcionarios_preparado = $conexaobd->prepare($hs_sel_funcionarios);
      $hs_sel_funcionarios_preparado->execute();

      if ($hs_sel_funcionarios_preparado->rowCount()>0){
        $hs_sel_funcionarios_dados = $hs_sel_funcionarios_preparado->fetch();
        if ((($g_usuarios=='000001')&&($hs_sel_funcionarios_dados['usuarios_id']=='000001'))&&$_SESSION['idUsuario']<>'000001'){
          echo "Você não tem permissão para visualizar esta página.";
        }else{
        $data = explode("-", $hs_sel_funcionarios_dados['data_nascimento']);;
    ?>
    <form name="frmupdfuncionarios" action="?pasta=funcionarios/registros/&arq=hs_upd_funcionarios&ext=php" method="post">
      <table>
        <input type="hidden" name="hidfuncionarios" value="<?php echo $hs_sel_funcionarios_dados['id'] ?>" />
        <input type="hidden" name="hidusuarios" value="<?php echo  $hs_sel_funcionarios_dados['usuarios_id'] ?>" />
        <tr>
          <td colspan="2" align="center">Campos com (*) são obrigatórios.</td>
        </tr>
        <tr>
          <td><br /></td>
        </tr>
        <tr>
          <td colspan="2"><h4>Dados Pessoais</h4> </td>
        </tr>
        <tr>
          <td> *Nome completo: </td>
          <td> <input type="text" name="txtnome" maxlength="45" value="<?php echo $hs_sel_funcionarios_dados['nome_completo'] ?>"/> </td>
        </tr>
        <tr>
          <td> *Data de Nascimento: </td>
          <td> <input type="text" name="txtdata" id="datepicker" maxlength="11" placeholder="dd/mm/aaaa" value="<?php echo $data['2']."/".$data['1']."/".$data['0'] ?>" readonly/> </td>
        </tr>
        <tr>
          <td> *RG: </td>
          <td> <input type="text" name="txtrg" maxlength="20" value="<?php echo $hs_sel_funcionarios_dados['rg'] ?>"/> </td>
        </tr>
        <tr>
          <td> *CPF: </td>
          <td> <input type="text" name="txtcpf" maxlength="11" placeholder="Apenas números" value="<?php echo $hs_sel_funcionarios_dados['cpf'] ?>"/> </td>
        </tr>
        <tr>
          <td> *Telefone: </td>
          <td> <input type="text" name="txttelefone" maxlength="15" placeholder="Com DDD, apenas números" value="<?php echo $hs_sel_funcionarios_dados['telefone'] ?>"/> </td>
        </tr>
        <tr>
          <td> *E-mail: </td>
          <td> <input type="text" name="txtemail" maxlength="70" value="<?php echo $hs_sel_funcionarios_dados['email'] ?>"/> </td>
        </tr>
        <tr>
          <td> *CEP: </td>
          <td> <input type="text" name="txtcep" maxlength="8" placeholder="Apenas números" value="<?php echo $hs_sel_funcionarios_dados['cep'] ?>"/> </td>
        </tr>
        <tr>
          <td> *Estado: </td>
          <td>
            <select name="selestado" id="selestado" onchange="mostraCidades()">
              <option value="">Escolha...</option>
              <?php
                $hs_sel_estados = "SELECT * FROM estados ORDER BY nome";
                $hs_sel_estados_preparado = $conexaobd->prepare($hs_sel_estados);
                $hs_sel_estados_preparado->execute();

                if($hs_sel_estados_preparado->rowCount()>0){
                  while ($hs_sel_estados_dados = $hs_sel_estados_preparado->fetch()) {
                    $selected   = "";

                    if($hs_sel_estados_dados['id']==$hs_sel_funcionarios_dados['estados_id']){
                      $selected = "selected";
                    }
                    echo "<option value='".$hs_sel_estados_dados['id']."'".$selected.">".$hs_sel_estados_dados['nome']."</option>";
                  }
                }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td> *Cidade: </td>
          <td>
            <select name="selcidade" id="selcidade">
              <option value="">Escolha...</option>
              <?php
                $hs_sel_cidades = "SELECT id, nome FROM cidades WHERE estados_id='".$hs_sel_funcionarios_dados['estados_id']."'";
                $hs_sel_cidades_preparado = $conexaobd->prepare($hs_sel_cidades);
                $hs_sel_cidades_preparado->execute();

                if($hs_sel_cidades_preparado->rowCount()>0){
                  while ($hs_sel_cidades_dados = $hs_sel_cidades_preparado->fetch()) {
                    $selected   = "";

                    if($hs_sel_cidades_dados['id']==$hs_sel_funcionarios_dados['cidades_id']){
                      $selected = "selected";
                    }
                    echo "<option value='".$hs_sel_cidades_dados['id']."'".$selected.">".$hs_sel_cidades_dados['nome']."</option>";
                  }
                }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td> *Bairro: </td>
          <td> <input type="text" name="txtbairro" maxlength="30" value="<?php echo $hs_sel_funcionarios_dados['bairro'] ?>"/> </td>
        </tr>
        <tr>
          <td> *Logradouro: </td>
          <td> <input type="text" name="txtlogradouro" maxlength="45" value="<?php echo $hs_sel_funcionarios_dados['logradouro'] ?>"/> </td>
        </tr>
        <tr>
          <td> *Número da residencia: </td>
          <td> <input type="text" name="txtresidencia" maxlength="5" value="<?php echo $hs_sel_funcionarios_dados['numero_residencia'] ?>"/> </td>
        </tr>
        <tr>
          <td> *Complemento: </td>
          <td> <input type="text" name="txtcomplemento" maxlength="20" placeholder="Casa" value="<?php echo $hs_sel_funcionarios_dados['complemento'] ?>"/> </td>
        </tr>
        <tr>
          <td> Observações: </td>
          <td> <textarea name="txaobservacoes"><?php echo $hs_sel_funcionarios_dados['observacoes'] ?></textarea> </td>
        </tr>
        <tr>
          <td colspan="2"><hr /></td>
        </tr>
        <tr>
          <td colspan="2"><h4>Dados de Acesso</h4> </td>
        </tr>
        <tr>
          <td> Permissão: </td>
          <td>
            <select name="selpermissao">
              <option value="">Escolha...</option>
              <option value="2" <?php if ($hs_sel_funcionarios_dados['permissao']==2){ echo "selected"; } ?>>Funcionário regular</option>
              <option value="1" <?php if ($hs_sel_funcionarios_dados['permissao']==1){ echo "selected"; } ?>>Funcionário financeiro</option>
              <option value="0" <?php if ($hs_sel_funcionarios_dados['permissao']==0){ echo "selected"; } ?>>Administrador</option>
            </select>
          </td>
        </tr>
        <tr>
          <td> Usuário: </td>
          <td> <input type="text" name="txtusuario" value="<?php echo $hs_sel_funcionarios_dados['usuario'] ?>"/> </td>
        </tr>
        <tr align="center">
          <td>
            <button type="reset" name="btnlimpar">Limpar</button>
          </td>
          <td>
            <button type="submit" name="btnsalvar">Salvar</button>
          </td>
        </tr>
      </table>
    </form>
    <?php
        }
      }
    ?>
  </div>
</div>
