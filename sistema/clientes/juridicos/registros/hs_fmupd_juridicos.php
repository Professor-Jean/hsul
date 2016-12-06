<h2>Registro de Pessoa Jurídica</h2>
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
  <?php
    $g_juridicos_id = $_GET['juridicos_id'];
    $g_clientes_id = $_GET['clientes_id'];

    $hs_sel_juridico = "SELECT clientesjuridicos.id AS juridico_id, estados.id AS estados_id, clientes.cidades_id AS cidades_id, clientesjuridicos.razao_social, clientes.nome, clientesjuridicos.atividade_principal, clientesjuridicos.telefone_empresa, clientesjuridicos.email_empresa, clientesjuridicos.cnpj, clientes.cep, clientes.bairro, clientes.logradouro, clientesjuridicos.numero_empresa, clientes.complemento, clientesjuridicos.nome_representante, clientesjuridicos.telefone_representante, clientes.observacoes FROM clientesjuridicos INNER JOIN clientes ON clientesjuridicos.clientes_id=clientes.id INNER JOIN cidades ON clientes.cidades_id=cidades.id INNER JOIN estados ON cidades.estados_id=estados.id WHERE clientesjuridicos.id='".$g_juridicos_id."'";
    $hs_sel_juridico_preparado = $conexaobd->prepare($hs_sel_juridico);
    $hs_sel_juridico_preparado->execute();
    $hs_sel_juridico_dados = $hs_sel_juridico_preparado->fetch();
  ?>
  <div class="registros">
    <form name="frmaltjuridico" method="POST" action="?pasta=clientes/juridicos/registros/&arq=hs_upd_juridicos&ext=php" onsubmit="return validacaoaltjuridico()">
      <input type="hidden" name="hidjuridicosid" value="<?php echo $g_juridicos_id; ?>"/>
      <input type="hidden" name="hidclientesid" value="<?php echo $g_clientes_id; ?>"/>
    <table>
      <tr>
        <td colspan="2" class="obg">Campos com (*) são obrigatórios.</td>
      </tr>
      <tr>
        <td>*Razão social:</td>
        <td> <input type="text" name="txtrazao" value="<?php echo $hs_sel_juridico_dados['razao_social']; ?>" maxlength="45"/> </td>
      </tr>
      <tr>
        <td>*Nome fantasia:</td>
        <td> <input type="text" name="txtfantasia" value="<?php echo $hs_sel_juridico_dados['nome']; ?>" maxlength="45"/> </td>
      </tr>
      <tr>
        <td>*Atividade principal:</td>
        <td> <input type="text" name="txtatvprincipal" value="<?php echo $hs_sel_juridico_dados['atividade_principal']; ?>" maxlength="20"/> </td>
      </tr>
      <tr>
        <td>*Telefone da empresa:</td>
        <td> <input type="text" name="txttelempresa" value="<?php echo $hs_sel_juridico_dados['telefone_empresa']; ?>" maxlength="15"/> </td>
      </tr>
      <tr>
        <td>*E-mail da empresa:</td>
        <td> <input type="text" name="txtemail" value="<?php echo $hs_sel_juridico_dados['email_empresa']; ?>" maxlength="70"/> </td>
      </tr>
      <tr>
        <td>*CNPJ:</td>
        <td> <input type="text" name="txtcnpj" value="<?php echo $hs_sel_juridico_dados['cnpj']; ?>" maxlength="14"/> </td>
      </tr>
      <tr>
        <td>*CEP:</td>
        <td> <input type="text" name="txtcep" value="<?php echo $hs_sel_juridico_dados['cep']; ?>" maxlength="10"/> </td>
      </tr>
      <tr>
        <td>*Estado:</td>
        <td>
          <select name="selestado" id="selestado" onchange="mostraCidades()">
            <option value="">Escolha</option>
            <?php
              $hs_sel_estados = "SELECT * FROM estados";
              $hs_sel_estados_preparado = $conexaobd->prepare($hs_sel_estados);
              $hs_sel_estados_preparado->execute();

              while($hs_sel_estados_dados = $hs_sel_estados_preparado->fetch()){
                $id_estados = $hs_sel_estados_dados['id'];
                $nome_estados = $hs_sel_estados_dados['nome'];

                if($id_estados==$hs_sel_juridico_dados['estados_id']){
                  echo "<option selected value='".$id_estados."'>".$nome_estados."</option>";
                }else{
                  echo "<option value='".$id_estados."'>".$nome_estados."</option>";
                }

              }
            ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>*Cidade:</td>
        <td>
          <select name="selcidade" id="selcidade">
            <option value="">Escolha</option>
            <?php
              $hs_sel_cidades = "SELECT * FROM cidades WHERE estados_id='".$hs_sel_juridico_dados['estados_id']."'";
              $hs_sel_cidades_preparado = $conexaobd->prepare($hs_sel_cidades);
              $hs_sel_cidades_preparado->execute();


              while($hs_sel_cidades_dados = $hs_sel_cidades_preparado->fetch()){

                $select = "";

                if($hs_sel_cidades_dados['id']==$hs_sel_juridico_dados['cidades_id']){

                  $select = "selected";
                }
            ?>
            <option value='<?php echo $hs_sel_cidades_dados['id']; ?>'<?php echo $select; ?>><?php echo $hs_sel_cidades_dados['nome']; ?></option>
            <?php
              }
            ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>*Bairro:</td>
        <td> <input type="text" name="txtbairro" value="<?php echo $hs_sel_juridico_dados['bairro']; ?>" maxlength="30"/> </td>
      </tr>
      <tr>
        <td>*Logradouro:</td>
        <td> <input type="text" name="txtlogradouro" value="<?php echo $hs_sel_juridico_dados['logradouro']; ?>" maxlength="45"/> </td>
      </tr>
      <tr>
        <td>*Número da empresa:</td>
        <td> <input type="text" name="txtnempresa" value="<?php echo $hs_sel_juridico_dados['numero_empresa']; ?>" maxlength="5"/> </td>
      </tr>
      <tr>
        <td>*Complemento:</td>
        <td> <input type="text" name="txtcomplemento" value="<?php echo $hs_sel_juridico_dados['complemento']; ?>" maxlength="20"/> </td>
      </tr>
      <tr>
        <td>*Nome do representante:</td>
        <td> <input type="text" name="txtrepresentante" value="<?php echo $hs_sel_juridico_dados['nome_representante']; ?>" maxlength="45"/> </td>
      </tr>
      <tr>
        <td>*Telefone do representante:</td>
        <td> <input type="text" name="txttelrepresentante" value="<?php echo $hs_sel_juridico_dados['telefone_representante']; ?>" maxlength="15"/> </td>
      </tr>
      <tr>
        <td>Observações:</td>
        <td><textarea name="txaobservacoes" value="value="<?php echo $hs_sel_juridico_dados['observacoes']; ?>""></textarea></td>
      </tr>
      <tr align="center">
        <td>
          <button type="reset">Limpar</button>
        </td>
        <td>
          <button type="submit" name="btnsalvar">Salvar</button>
        </td>
      </tr>
    </table>
  </form>
  </div>
</div>
