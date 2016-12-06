        <h2>Registro de Cidade</h2>
        <div>
          <div class="registros">
            <form name="frmcadcidade" method="POST" action="?pasta=localidades/cidades/&arq=hs_ins_cidades&ext=php" onsubmit="return validacaocidade()">
            <table>
              <tr>
                <td colspan="2" class="obg">Campos com (*) são obrigatórios.</td>
              </tr>
              <tr>
                <td>*Estado:</td>
                <td>
                  <select name="selestado">
                    <option value="">Selecione</option>
                    <?php
                      $hs_sel_estados = "SELECT * FROM estados GROUP BY nome ORDER BY nome";
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
                <td>*Nome da cidade:</td>
                <td> <input type="text" name="txtnome" maxlenght="45"/> </td>
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
            $hs_sel_cidades = "SELECT cidades.id AS id, cidades.nome AS cidade_nome, estados.id AS id_do_estado, estados.nome AS estado_nome FROM cidades INNER JOIN estados ON cidades.estados_id=estados.id ORDER BY cidades.nome ASC";
            $hs_sel_cidades_preparado = $conexaobd->prepare($hs_sel_cidades);
            $hs_sel_cidades_preparado->execute();
          ?>
          <table>
            <thead>
              <tr>
                <th>Nome</th>
                <th>Estado</th>
                <th>Editar</th>
                <th>Excluir</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if($hs_sel_cidades_preparado->rowCount() > 0){
                while($hs_sel_cidades_dados = $hs_sel_cidades_preparado->fetch()){
              ?>
              <tr>
                <td><?php echo $hs_sel_cidades_dados['cidade_nome']; ?></td>
                <td><?php echo $hs_sel_cidades_dados['estado_nome']; ?></td>
                <td align="center"><a href="?pasta=localidades/cidades/&arq=hs_fmupd_cidades&ext=php&id=<?php echo $hs_sel_cidades_dados['id'];?>" title="Editar cidade"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>

                <td align="center"><a title="Excluir registro"><?php echo confirmacao_exclusao($hs_sel_cidades_dados['id'], 'vazio', '?pasta=localidades/cidades/&arq=hs_del_cidades&ext=php', 'cidade',  $hs_sel_cidades_dados['cidade_nome']); ?></a></td>
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
