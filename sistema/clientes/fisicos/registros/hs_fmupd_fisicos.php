
<h2>Registro de Pessoa Física</h2>
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
<?php
  $g_fisicos_id = $_GET['fisicos_id'];
  $g_clientes_id = $_GET['clientes_id'];

    $hs_sel_fisicos = "SELECT clientesfisicos.id AS id_fisicos, clientes.nome, clientesfisicos.data_nascimento, clientesfisicos.rg, clientesfisicos.cpf, clientesfisicos.telefone, clientesfisicos.email, clientes.cep, clientes.bairro, clientes.logradouro, clientesfisicos.numero_residencia, clientes.complemento, clientes.observacoes, clientes.cidades_id AS cidades_id, estados.id AS id_estados FROM clientesfisicos INNER JOIN clientes ON clientesfisicos.clientes_id=clientes.id INNER JOIN cidades ON clientes.cidades_id=cidades.id INNER JOIN estados ON cidades.estados_id=estados.id WHERE clientesfisicos.id='".$g_fisicos_id."'";
    $hs_sel_fisicos_preparado = $conexaobd->prepare($hs_sel_fisicos);
    $hs_sel_fisicos_preparado->execute();
    $hs_sel_fisicos_dados = $hs_sel_fisicos_preparado->fetch();
    $data = explode("-", $hs_sel_fisicos_dados['data_nascimento']);
?>
<div>
  <div class="registros">
    <form name="frmaltfisico" method="POST" action="?pasta=clientes/fisicos/registros/&arq=hs_upd_fisicos&ext=php" onsubmit="return validacaoaltfisico()">
      <input type="hidden" name="hidfisicosid" value="<?php echo $g_fisicos_id; ?>"/>
      <input type="hidden" name="hidclientesid" value="<?php echo $g_clientes_id; ?>"/>
    <table>
      <tr>
        <td colspan="2" class="obg">Campos com (*) são obrigatórios.</td>
      </tr>
      <tr>
        <td>*Nome completo:</td>
        <td> <input type="text" name="txtnome" value="<?php echo $hs_sel_fisicos_dados['nome']; ?>" maxlength="45"/> </td>
      </tr>
      <tr>
        <td>*Data de nascimento:</td>
        <td> <input type="text" name="txtdata" value="<?php echo $data['2']."/".$data['1']."/".$data['0']; ?>"  readonly='readonly' id="datepicker" maxlength="45"/> </td>
      </tr>
      <tr>
        <td>*RG:</td>
        <td> <input type="text" name="txtrg" value="<?php echo $hs_sel_fisicos_dados['rg']; ?>" maxlength="20"/> </td>
      </tr>
      <tr>
        <td>*CPF:</td>
        <td> <input type="text" name="txtcpf" value="<?php echo $hs_sel_fisicos_dados['cpf']; ?>" maxlength="15"/> </td>
      </tr>
      <tr>
        <td>*Telefone:</td>
        <td> <input type="text" name="txttelefone" value="<?php echo $hs_sel_fisicos_dados['telefone']; ?>" maxlength="70"/> </td>
      </tr>
      <tr>
        <td>*E-mail:</td>
        <td> <input type="text" name="txtemail" value="<?php echo $hs_sel_fisicos_dados['email']; ?>" maxlength="100"/> </td>
      </tr>
      <tr>
        <td>*CEP:</td>
        <td> <input type="text" name="txtcep" value="<?php echo $hs_sel_fisicos_dados['cep']; ?>" maxlength="10"/> </td>
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
            echo $hs_sel_estados;


            while($hs_sel_estados_dados = $hs_sel_estados_preparado->fetch()){
              $id_estados = $hs_sel_estados_dados['id'];
              $nome_estados = $hs_sel_estados_dados['nome'];

              if($id_estados==$hs_sel_fisicos_dados['id_estados']){
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
            $hs_sel_cidades = "SELECT * FROM cidades WHERE estados_id='".$hs_sel_fisicos_dados['id_estados']."'";
            $hs_sel_cidades_preparado = $conexaobd->prepare($hs_sel_cidades);
            $hs_sel_cidades_preparado->execute();

            while($hs_sel_cidades_dados = $hs_sel_cidades_preparado->fetch()){
              $id_cidades = $hs_sel_cidades_dados['id'];
              $nome_cidades = $hs_sel_cidades_dados['nome'];

              if($id_cidades==$hs_sel_fisicos_dados['cidades_id']){
                echo "<option selected value='".$id_cidades."'>".$nome_cidades."</option>";
              }else{
                echo "<option value='".$id_cidades."'>".$nome_cidades."</option>";
              }

            }
            ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>*Bairro:</td>
        <td> <input type="text" name="txtbairro" value="<?php echo $hs_sel_fisicos_dados['bairro']; ?>" maxlength="30"/> </td>
      </tr>
      <tr>
        <td>*Logradouro:</td>
        <td> <input type="text" name="txtlogradouro" value="<?php echo $hs_sel_fisicos_dados['logradouro']; ?>" maxlength="45"/> </td>
      </tr>
      <tr>
        <td>*Número da residência:</td>
        <td> <input type="text" name="txtnresidencia" value="<?php echo $hs_sel_fisicos_dados['numero_residencia']; ?>" maxlength="5"/> </td>
      </tr>
      <tr>
        <td>*Complemento:</td>
        <td> <input type="text" name="txtcomplemento" value="<?php echo $hs_sel_fisicos_dados['complemento']; ?>" maxlength="20"/> </td>
      </tr>
      <tr>
        <td>Observações:</td>
        <td><textarea name="txaobservacoes" value="value="<?php echo $hs_sel_fisicos_dados['observacoes']; ?>""></textarea></td>
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
