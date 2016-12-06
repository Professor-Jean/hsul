<h2>Consulta de Pessoa Jurídica</h2>
<div>
  <?php
  $hs_sel_juridicos = "SELECT clientesjuridicos.id AS juridicos_id, clientes.id AS clientes_id, clientes.nome, clientesjuridicos.nome_representante, clientesjuridicos.telefone_empresa FROM clientesjuridicos INNER JOIN clientes ON clientesjuridicos.clientes_id=clientes.id"; //select para selecionar o id da data, com metade da sintaxe para completar embaixo

  if((isset($_POST['txtnome']))||(isset($_POST['txtrepresentante']))||(isset($_POST['txttelefone']))){
   $hs_sel_juridicos.=" WHERE ";
   $p_nome = $_POST['txtnome']; // coloca o post em uma variável para facilitar
   $hs_sel_juridicos.=" clientes.nome LIKE '%".$p_nome."%' AND"; //e completa a sintaxe

   $p_representante = $_POST['txtrepresentante'];// coloca o post em uma variável para facilitar
   $hs_sel_juridicos.=" clientesjuridicos.nome_representante LIKE '%".$p_representante."%' AND";//e completa a sintaxe

   $p_telefone = $_POST['txttelefone'];
   $hs_sel_juridicos.=" clientesjuridicos.telefone_empresa LIKE '%".$p_telefone."%' AND";//e completa a sintaxe

   $hs_sel_juridicos = substr($hs_sel_juridicos, 0, -3); //substr para tirar os 3 ultimos itens que são o 'and'

   }
   $hs_sel_juridicos_preparado = $conexaobd->prepare($hs_sel_juridicos); //preparando
   $hs_sel_juridicos_preparado->execute(); //executando
   ?>
  <div class="registros_filtro">
    <fieldset>
      <legend>Filtro de Pesquisa</legend>
      <form name="frmfiltrofisico" method="POST" action="?pasta=clientes/juridicos/consultas/&arq=hs_con_juridicos&ext=php">
        <table>
          <tr>
            <td>Nome fantasia:</td>
            <td> <input type="text" name="txtnome" maxlenght="45"/> </td>
          </tr>
          <tr>
            <td>Nome do representante:</td>
            <td> <input type="text" name="txtrepresentante" maxlenght="60"/> </td>
          </tr>
          <tr>
            <td>Telefone da empresa:</td>
            <td> <input type="text" name="txttelefone" maxlenght="15"/> </td>
          </tr>
          <tr align="center">
            <td>
              <button type="reset">Limpar</button>
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
          <th>Nome fantasia</th>
          <th>Nome do representante</th>
          <th>Telefone da empresa</th>
          <th>Visualizar</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if($hs_sel_juridicos_preparado->rowCount() > 0){
            while($hs_sel_juridicos_dados = $hs_sel_juridicos_preparado->fetch()){ //captando os dados e colocando em uma variavel, fetch();para pegar a proxima data que tiver.
        ?>
        <tr>
          <td align="center"><?php echo $hs_sel_juridicos_dados['nome']; ?></td>
          <td align="center"><?php echo $hs_sel_juridicos_dados['nome_representante']; ?></td>
          <td align="center"><?php echo $hs_sel_juridicos_dados['telefone_empresa']; ?></td>
          <td align="center"><a href="?pasta=clientes/juridicos/consultas/&arq=hs_con_det_juridicos&ext=php&juridicos_id=<?php echo $hs_sel_juridicos_dados['juridicos_id'];?>&clientes_id=<?php echo $hs_sel_juridicos_dados['clientes_id']; ?>" title="Visualizar cliente"><i class="fa fa-search" aria-hidden="true"></i></a></td>
        </tr>
        <?php
          }
          }else{
            ?>
        <tr>
          <td colspan="9" align="center"> Não há registros</td>
        </tr>
        <?php
          }
        ?>
      </tbody>
    </table>
  </fieldset>
</div>
