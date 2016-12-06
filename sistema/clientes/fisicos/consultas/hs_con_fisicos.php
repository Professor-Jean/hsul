        <h2>Consulta de Pessoa Física</h2>
        <div>
          <?php
          $hs_sel_fisicos = "SELECT clientesfisicos.id, clientes.nome, clientes.logradouro, clientesfisicos.numero_residencia FROM clientesfisicos INNER JOIN clientes ON clientesfisicos.clientes_id=clientes.id"; //select para selecionar o id da data, com metade da sintaxe para completar embaixo

           if((isset($_POST['txtnome']))||(isset($_POST['txtlogradouro']))||(isset($_POST['txtnresidencia']))){
            $hs_sel_fisicos.=" WHERE ";
          	$p_nome = $_POST['txtnome']; // coloca o post em uma variável para facilitar
            $hs_sel_fisicos.=" clientes.nome LIKE '%".$p_nome."%' AND"; //e completa a sintaxe

            $p_logradouro = $_POST['txtlogradouro'];// coloca o post em uma variável para facilitar
            $hs_sel_fisicos.=" clientes.logradouro LIKE '%".$p_logradouro."%' AND";//e completa a sintaxe

            $p_nresidencia = $_POST['txtnresidencia'];
            $hs_sel_fisicos.=" clientesfisicos.numero_residencia LIKE '%".$p_nresidencia."%' AND";//e completa a sintaxe

            $hs_sel_fisicos = substr($hs_sel_fisicos, 0, -3); //substr para tirar os 3 ultimos itens que são o 'and'

            }
            $hs_sel_fisicos_preparado = $conexaobd->prepare($hs_sel_fisicos); //preparando
            $hs_sel_fisicos_preparado->execute(); //executando
           ?>
          <div class="registros_filtro">
            <fieldset>
              <legend>Filtro de Pesquisa</legend>
              <form name="frmfiltrofisico" method="POST" action="?pasta=clientes/fisicos/consultas/&arq=hs_con_fisicos&ext=php">
                <table>
                  <tr>
                    <td>Nome do cliente:</td>
                    <td> <input type="text" name="txtnome" maxlenght="60"/> </td>
                  </tr>
                  <tr>
                    <td>Logradouro:</td>
                    <td> <input type="text" name="txtlogradouro" maxlenght="45"/> </td>
                  </tr>
                  <tr>
                    <td>Número da residência:</td>
                    <td> <input type="text" name="txtnresidencia" maxlenght="5"/> </td>
                  </tr>
                  <tr align="center">
                    <td>
                      <button id="buttonreset" type="reset">Limpar</button>
                    </td>
                    <td>
                      <button type="submit">Pesquisar</button>
                    </td>
                  </tr>
                </table>
            </form>
            </div>
          </div>
          <div class="consultas">
            <table>
              <thead>
                <tr>
                  <th>Nome do cliente</th>
                  <th>Logradouro</th>
                  <th>Número da residência</th>
                  <th>Visualizar</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if($hs_sel_fisicos_preparado->rowCount() > 0){
                    while($hs_sel_fisicos_dados = $hs_sel_fisicos_preparado->fetch()){ //captando os dados e colocando em uma variavel, fetch();para pegar a proxima data que tiver.
                ?>
          			<tr>
          				<td align="center"><?php echo $hs_sel_fisicos_dados['nome']; ?></td>
          				<td align="center"><?php echo $hs_sel_fisicos_dados['logradouro']; ?></td>
          				<td align="center"><?php echo $hs_sel_fisicos_dados['numero_residencia']; ?></td>
          				<td align="center"><a href="?pasta=clientes/fisicos/consultas/&arq=hs_con_detfisicos&ext=php&id=<?php echo $hs_sel_fisicos_dados['id'];?>" title="Visualizar cliente"><i class="fa fa-search" aria-hidden="true"></i></a></td>

          			</tr>
                <?php
                  }
                  }else{
                    ?>
                <tr>
                  <td colspan="4" align="center"> Não há registros</td>
                </tr>
                <?php
                  }
                ?>
          		</tbody>
            </table>
          </fieldset>
        </div>
