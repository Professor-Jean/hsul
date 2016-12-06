        <h2>Registro de Pessoa Jurídica</h2>
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
            <form name="frmcadjuridico" method="POST" action="?pasta=clientes/juridicos/registros/&arq=hs_ins_juridicos&ext=php" onsubmit="return validacaojuridico()">
            <table>
              <tr>
                <td colspan="2" class="obg">Campos com (*) são obrigatórios.</td>
              </tr>
              <tr>
                <td>*Razão social:</td>
                <td> <input type="text" name="txtrazao" maxlength="45" /> </td>
              </tr>
              <tr>
                <td>*Nome fantasia:</td>
                <td> <input type="text" name="txtfantasia" maxlength="45"/> </td>
              </tr>
              <tr>
                <td>*Atividade principal:</td>
                <td> <input type="text" name="txtatvprincipal" maxlength="20"/> </td>
              </tr>
              <tr>
                <td>*Telefone da empresa:</td>
                <td> <input type="text" name="txttelempresa" maxlength="15" placeholder="Com DDD e apenas números"/> </td>
              </tr>
              <tr>
                <td>*E-mail da empresa:</td>
                <td> <input type="text" name="txtemail" maxlength="70" placeholder="fulano@detal.com"/> </td>
              </tr>
              <tr>
                <td>*CNPJ:</td>
                <td> <input type="text" name="txtcnpj" maxlength="18" placeholder="xxxxxxxxxxxxxx"/> </td>
              </tr>
              <tr>
                <td>*CEP:</td>
                <td> <input type="text" name="txtcep" maxlength="10" placeholder="xxxxxxxx"/> </td>
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
                <td> <input type="text" name="txtbairro" maxlength="45"/> </td>
              </tr>
              <tr>
                <td>*Logradouro:</td>
                <td> <input type="text" name="txtlogradouro" maxlength="60"/> </td>
              </tr>
              <tr>
                <td>*Número da empresa:</td>
                <td> <input type="text" name="txtnempresa" maxlength="5"/> </td>
              </tr>
              <tr>
                <td>*Complemento:</td>
                <td> <input type="text" name="txtcomplemento" maxlength="20"/> </td>
              </tr>
              <tr>
                <td>*Nome do representante:</td>
                <td> <input type="text" name="txtrepresentante" maxlength="60"/> </td>
              </tr>
              <tr>
                <td>*Telefone do representante:</td>
                <td> <input type="text" name="txttelrepresentante" maxlength="15" placeholder="Com DDD e apenas números"/> </td>
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
                  <button type="submit" name="btnsalvar">Salvar</button>
                </td>
              </tr>
            </table>
          </form>
          </div>
        </div>
        <div class="consultas">
          <?php
            $hs_sel_juridico = "SELECT clientesjuridicos.id AS juridicos_id, clientes.id AS clientes_id, clientes.nome AS nome_cliente, clientesjuridicos.nome_representante AS nome_representante, clientesjuridicos.telefone_empresa FROM clientesjuridicos INNER JOIN clientes ON clientesjuridicos.clientes_id=clientes.id";
            $hs_sel_juridico_preparado = $conexaobd->prepare($hs_sel_juridico);
            $hs_sel_juridico_preparado->execute();
           ?>
          <table>
            <thead>
              <tr>
                <th>Nome fantasia</th>
                <th>Nome do representante</th>
                <th>Telefone da empresa</th>
                <th>Visualizar</th>
                <th>Editar</th>
                <th>Excluir</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if($hs_sel_juridico_preparado->rowCount() > 0){
                  while($hs_sel_juridico_dados = $hs_sel_juridico_preparado->fetch()){
                    $telefone_empresa = preg_replace('/^(\d{2})(\d{4,5})(\d{4})$/', '($1) $2-$3', $hs_sel_juridico_dados['telefone_empresa']);
              ?>
              <tr>
                <td><?php echo $hs_sel_juridico_dados['nome_cliente'];?></td>
                <td><?php echo $hs_sel_juridico_dados['nome_representante']; ?></td>
                <td><?php echo $telefone_empresa; ?></td>
                <td align="center"><a href="?pasta=clientes/juridicos/consultas/&arq=hs_con_det_juridicos&ext=php&juridicos_id=<?php echo $hs_sel_juridico_dados['juridicos_id'];?>&clientes_id=<?php echo $hs_sel_juridico_dados['clientes_id']; ?>" title="Deletar cliente"><i class="fa fa-search" aria-hidden="true"></i></a></td>
                <td align="center"><a href="?pasta=clientes/juridicos/registros/&arq=hs_fmupd_juridicos&ext=php&juridicos_id=<?php echo $hs_sel_juridico_dados['juridicos_id'];?>&clientes_id=<?php echo $hs_sel_juridico_dados['clientes_id']; ?>" title="Editar cliente"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                <td align="center"><a title="Excluir registro"><?php echo confirmacao_exclusao($hs_sel_juridico_dados['juridicos_id'], $hs_sel_juridico_dados['clientes_id'], '?pasta=clientes/juridicos/registros/&arq=hs_del_juridicos&ext=php', 'o cliente',  $hs_sel_juridico_dados['nome_cliente']); ?></a></td>
              </tr>
              <?php
                }
                }else{//fechando a estrutura de repetiçÃo
              ?>
              <tr>
                <td align="center" colspan="6">Não há registros</td>
              </tr>
              <?php
                }
              ?>
            </tbody>
          </table>
        </div>
