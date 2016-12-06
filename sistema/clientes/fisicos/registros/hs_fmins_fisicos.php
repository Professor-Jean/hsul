        <h2>Registro de Pessoa Física</h2>
        <script>
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
              <form name="frmcadfisico" method="POST" action="?pasta=clientes/fisicos/registros/&arq=hs_ins_fisicos&ext=php" onsubmit="return validacaofisico()">
            <table>
              <tr>
                <td colspan="2" class="obg">Campos com (*) são obrigatórios.</td>
              </tr>
              <tr>
                <td>*Nome completo:</td>
                <td> <input type="text" name="txtnome" maxlength="50"/> </td>
              </tr>
              <tr>
                <td>*Data de nascimento:</td>
                <td> <input type="text" name="txtdata" readonly='readonly' id="datepicker" placeholder="DD/MM/AAAA"/> </td>
              </tr>
              <tr>
                <td>*RG:</td>
                <td> <input type="text" name="txtrg" maxlength="12"/> </td>
              </tr>
              <tr>
                <td>*CPF:</td>
                <td> <input type="text" name="txtcpf" placeholder="xxxxxxxxxxx" maxlength="14"/> </td>
              </tr>
              <tr>
                <td>*Telefone:</td>
                <td> <input type="text" name="txttelefone" placeholder="Com DDD e apenas números" maxlength="15"/> </td>
              </tr>
              <tr>
                <td>*E-mail:</td>
                <td> <input type="text" name="txtemail" placeholder="fulano@detal.com" maxlength="70"/> </td>
              </tr>
              <tr>
                <td>*CEP:</td>
                <td> <input type="text" name="txtcep" placeholder="xxxxxxxx" maxlength="10"/> </td>
              </tr>
              <tr>
                <td>*Estado:</td>
                <td>
                  <select name="selestado" id="selestado" onchange="mostraCidades()">
                    <option value="">Escolha</option>
                    <?php
                      $hs_sel_estados = "SELECT * FROM estados GROUP BY nome";
                      $hs_sel_estados_preparado = $conexaobd->prepare($hs_sel_estados);
                      $hs_sel_estados_preparado->execute();

                      while($hs_sel_estados_dados = $hs_sel_estados_preparado->fetch()){
                        $id_estados = $hs_sel_estados_dados['id'];
                        $nome_estados = $hs_sel_estados_dados['nome'];
                        echo "<option value='".$id_estados."'>".$nome_estados."</option>";
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
                  </select>
                </td>
              </tr>
              <tr>
                <td>*Bairro:</td>
                <td> <input type="text" name="txtbairro" maxlength="45" /> </td>
              </tr>
              <tr>
                <td>*Logradouro:</td>
                <td> <input type="text" name="txtlogradouro" maxlength="60"/> </td>
              </tr>
              <tr>
                <td>*Número da residência:</td>
                <td> <input type="text" name="txtnresidencia" maxlength="5"/> </td>
              </tr>
              <tr>
                <td>*Complemento:</td>
                <td> <input type="text" name="txtcomplemento" maxlength="20"/> </td>
              </tr>
              <tr>
                <td>Observações:</td>
                <td><textarea name="txaobservacoes"></textarea></td>
              </tr>
              <tr align="center">
                <td>
                  <button type="reset">Limpar</button>
                </td>
                <td>
                  <button type="submit">Salvar</button>
                </td>
              </tr>
            </table>
          </form>
          </div>
        </div>
        <div class="consultas">
          <?php
          $hs_sel_fisicos = "SELECT clientesfisicos.id AS fisicos_id, clientes.id clientes_id, clientes.nome AS nome_cliente, clientesfisicos.telefone, clientesfisicos.email, clientes.logradouro FROM clientesfisicos INNER JOIN clientes ON clientesfisicos.clientes_id=clientes.id";
          $hs_sel_fisicos_preparado = $conexaobd->prepare($hs_sel_fisicos);
          $hs_sel_fisicos_preparado->execute();
          ?>
          <table>
            <thead>
              <tr>
                <th>Nome completo</th>
                <th>Telefone</th>
                <th>E-mail</th>
                <th>Logradouro</th>
                <th>Visualizar</th>
                <th>Editar</th>
                <th>Excluir</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if($hs_sel_fisicos_preparado->rowCount() > 0){
                  while($hs_sel_fisicos_dados = $hs_sel_fisicos_preparado->fetch()){
                    $telefone = preg_replace('/^(\d{2})(\d{4,5})(\d{4})$/', '($1) $2-$3', $hs_sel_fisicos_dados['telefone']);
              ?>
              <tr>
                <td><?php echo $hs_sel_fisicos_dados['nome_cliente']; ?></td>
                <td><?php echo $telefone; ?></td>
                <td><?php echo $hs_sel_fisicos_dados['email']; ?></td>
                <td><?php echo $hs_sel_fisicos_dados['logradouro']; ?></td>
                <td align="center"><a href="?pasta=clientes/fisicos/consultas/&arq=hs_con_detfisicos&ext=php&id=<?php echo $hs_sel_fisicos_dados['fisicos_id'];?>" title="Visualizar cliente"><i class="fa fa-search" aria-hidden="true"></i></a></td>
                <td align="center"><a href="?pasta=clientes/fisicos/registros/&arq=hs_fmupd_fisicos&ext=php&fisicos_id=<?php echo $hs_sel_fisicos_dados['fisicos_id'];?>&clientes_id=<?php echo $hs_sel_fisicos_dados['clientes_id']; ?>" title="Editar cliente"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                <td align="center"><a title="Excluir registro"><?php echo confirmacao_exclusao($hs_sel_fisicos_dados['fisicos_id'], $hs_sel_fisicos_dados['clientes_id'], '?pasta=clientes/fisicos/registros/&arq=hs_del_fisicos&ext=php', 'o cliente',  $hs_sel_fisicos_dados['nome_cliente']); ?></a></td>

              </tr>
              <?php
                }
                }else{//fechando a estrutura de repetiçÃo
              ?>
              <tr>
                <td align="center" colspan="7">Não há registros</td>
              </tr>
              <?php
                }
              ?>
            </tbody>
          </table>
        </div>
