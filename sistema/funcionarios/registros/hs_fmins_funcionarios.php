<h2>Registro de Funcionário</h2>
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
    <form name="frmfuncionarios" action="?pasta=funcionarios/registros/&arq=hs_ins_funcionarios&ext=php" method="post">
      <table>
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
          <td> <input type="text" name="txtnome" maxlength="45" /> </td>
        </tr>
        <tr>
          <td> *Data de Nascimento: </td>
          <td> <input type="text" name="txtdata" id="datepicker" maxlength="11" placeholder="dd/mm/aaaa" readonly/> </td>
        </tr>
        <tr>
          <td> *RG: </td>
          <td> <input type="text" name="txtrg" maxlength="20"/> </td>
        </tr>
        <tr>
          <td> *CPF: </td>
          <td> <input type="text" name="txtcpf" maxlength="11" placeholder="Apenas números"/> </td>
        </tr>
        <tr>
          <td> *Telefone: </td>
          <td> <input type="text" name="txttelefone" maxlength="11" placeholder="Com DDD, apenas números"/> </td>
        </tr>
        <tr>
          <td> *E-mail: </td>
          <td> <input type="text" name="txtemail" maxlength="70"/> </td>
        </tr>
        <tr>
          <td> *CEP: </td>
          <td> <input type="text" name="txtcep" maxlength="8" placeholder="Apenas números"/> </td>
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
                    echo "<option value='".$hs_sel_estados_dados['id']."'>".$hs_sel_estados_dados['nome']."</option>";
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
            </select>
          </td>
        </tr>
        <tr>
          <td> *Bairro: </td>
          <td> <input type="text" name="txtbairro" maxlength="30"/> </td>
        </tr>
        <tr>
          <td> *Logradouro: </td>
          <td> <input type="text" name="txtlogradouro" maxlength="45"/> </td>
        </tr>
        <tr>
          <td> *Número da residencia: </td>
          <td> <input type="text" name="txtresidencia" maxlength="5"/> </td>
        </tr>
        <tr>
          <td> *Complemento: </td>
          <td> <input type="text" name="txtcomplemento" maxlength="20" placeholder="Casa"/> </td>
        </tr>
        <tr>
          <td> Observações: </td>
          <td> <textarea name="txaobservacoes"></textarea> </td>
        </tr>
        <tr>
          <td colspan="2"><hr /></td>
        </tr>
        <tr>
          <td colspan="2"><h4>Dados de Acesso</h4> </td>
        </tr>
        <tr>
          <td> *Permissão: </td>
          <td>
            <select name="selpermissao">
              <option value="">Escolha...</option>
              <option value="2">Funcionário regular</option>
              <option value="1">Funcionário financeiro</option>
              <option value="0">Administrador</option>
            </select>
          </td>
        </tr>
        <tr>
          <td> *Usuário: </td>
          <td> <input type="text" name="txtusuario"/> </td>
        </tr>
        <tr>
          <td> *Senha: </td>
          <td> <input type="password" name="pwdsenha"/> </td>
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
  </div>
</div>
<div class="consultas">
  <?php
    $hs_sel_funcionarios = "SELECT id, nome_completo, data_nascimento, telefone, usuarios_id FROM funcionarios ORDER BY nome_completo ASC";
    $hs_sel_funcionarios_preparado = $conexaobd->prepare($hs_sel_funcionarios);
    $hs_sel_funcionarios_preparado->execute();
  ?>
  <table>
    <thead>
      <tr>
        <th width="40%">Nome completo</th>
        <th width="25%">Data de nascimento</th>
        <th width="20%">Telefone</th>
        <th width="5%">Visualizar</th>
        <th width="5%">Editar</th>
        <th width="5%">Excluir</th>
      </tr>
    </thead>
    <tbody>
      <?php
        if($hs_sel_funcionarios_preparado->rowCount()>0){
          while ($hs_sel_funcionarios_resultados = $hs_sel_funcionarios_preparado->fetch()){
            $telefone = preg_replace('/^(\d{2})(\d{4,5})(\d{4})$/', '($1) $2-$3', $hs_sel_funcionarios_resultados['telefone']);
            $data = explode("-", $hs_sel_funcionarios_resultados['data_nascimento']);
      ?>
      <tr>
        <td><?php echo $hs_sel_funcionarios_resultados['nome_completo']?></td>
        <td><?php echo $data[2]."/".$data[1]."/".$data[0] ?></td>
        <td><?php echo $telefone ?></td>
        <td><a href="?pasta=funcionarios/consultas/&arq=hs_con_detfuncionarios&ext=php&funcionarios_id=<?php echo $hs_sel_funcionarios_resultados['id'] ?>&usuarios_id=<?php echo  $hs_sel_funcionarios_resultados['usuarios_id'] ?>"><i class="fa fa-search" aria-hidden="true"></i></a></td>
        <td><a href="?pasta=funcionarios/registros/&arq=hs_fmupd_funcionarios&ext=php&funcionarios_id=<?php echo $hs_sel_funcionarios_resultados['id'] ?>&usuarios_id=<?php echo  $hs_sel_funcionarios_resultados['usuarios_id'] ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
        <td><a title="Excluir registro"><?php echo confirmacao_exclusao($hs_sel_funcionarios_resultados['id'], '', '?pasta=funcionarios/registros/&arq=hs_del_funcionarios&ext=php', 'esse funcionário', $hs_sel_funcionarios_resultados['nome_completo']);?></a></td>
      </tr>
      <?php
          }
        }else{
      ?>
      <tr>
        <td colspan="7" align="center">Não há registros.</td>
      </tr>
      <?php
        }
      ?>
    </tbody>
  </table>
</div>
