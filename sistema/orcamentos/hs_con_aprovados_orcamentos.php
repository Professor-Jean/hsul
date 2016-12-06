<h2>Consulta de Orçamentos Aprovados</h2>
<div>
  <fieldset class="filtros">
    <legend>Filtros de Pesquisa</legend>
    <form name="frmfiltroaprovados" action="?pasta=orcamentos/&arq=hs_con_declinados_orcamentos&ext=php" method="post">
      <table>
        <tr>
          <td>Código do orçamento: </td>
          <td> <input text="text" name="txtcodigo" maxlength="6"/> </td>
        </tr>
        <tr>
          <td>Nome do cliente: </td>
          <td> <input text="text" name="txtnome" maxlength="45"/> </td>
        </tr>
        <tr>
          <td>Logradouro do serviço: </td>
          <td> <input text="text" name="txtlogradouro" maxlength="45"/> </td>
        </tr>
        <tr>
          <td>Data do serviço: </td>
          <td>
            <input text="text" name="txtdata" id="datepicker" readonly />
          </td>
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
  </fieldset>
</div>
<div class="consultas">
  <?php
    $hs_sel_orcamentos = "SELECT orcamentos.id, clientes.nome, orcamentos.data_inicio FROM orcamentos INNER JOIN clientes ON orcamentos.clientes_id=clientes.id WHERE orcamentos.status='1'";

    if((isset($_POST['txtcodigo']))||(isset($_POST['txtnome']))||(isset($_POST['txtlogradouro']))||(isset($_POST['txtdata']))){
      $hs_sel_orcamentos .= " AND";

     $p_codigo = $_POST['txtcodigo']; // coloca o post em uma variável para facilitar
     $hs_sel_orcamentos.=" orcamentos.id LIKE '%".$p_nome."%' AND"; //e completa a sintaxe

     $p_nome = $_POST['txtnome'];// coloca o post em uma variável para facilitar
     $hs_sel_orcamentos.=" clientes.nome LIKE '%".$p_nome."%' AND";//e completa a sintaxe

     $p_logradouro = $_POST['txtlogradouro'];// coloca o post em uma variável para facilitar
     $hs_sel_orcamentos.=" orcamentos.logradouro LIKE '%".$p_logradouro."%' AND";//e completa a sintaxe

     $p_data = $_POST['txtdata'];// coloca o post em uma variável para facilitar
     $hs_sel_orcamentos.=" orcamentos.data_inicio='".$p_data."' AND";//e completa a sintaxe

     $hs_sel_orcamentos = substr($hs_sel_orcamentos, 0, -3); //substr para tirar os 3 ultimos itens que são o 'and'
     }

    $hs_sel_orcamentos_preparado = $conexaobd->prepare($hs_sel_orcamentos);
    $hs_sel_orcamentos_preparado->execute();
  ?>
  <table>
    <thead>
      <tr>
        <th width="20%">Código do orçamento</th>
        <th width="50%">Nome do cliente</th>
        <th width="20%">Data do serviço</th>
        <th width="10%">Visualizar</th>
      </tr>
    </thead>
    <tbody>
      <?php
        if($hs_sel_orcamentos_preparado->rowCount()>0){
          while($hs_sel_orcamentos_dados = $hs_sel_orcamentos_preparado->fetch()){
      ?>
      <tr>
        <td><?php echo $hs_sel_orcamentos_dados['id']?></td>
        <td><?php echo $hs_sel_orcamentos_dados['nome']?></td>
        <td><?php echo $hs_sel_orcamentos_dados['data_inicio']?></td>
        <td><a href="?pasta=orcamentos/&arq=hs_con_det_orcamentos&ext=php&id=<?php echo $hs_sel_orcamentos_dados['id']?>"><i class="fa fa-search" aria-hidden="true"></i></a></td>
      </tr>
      <?php
          }
        }else{
      ?>
      <tr>
        <td colspan="4" align="center">Não há registros.</td>
      </tr>
      <?php
        }
      ?>
    </tbody>
  </table>
</div>
