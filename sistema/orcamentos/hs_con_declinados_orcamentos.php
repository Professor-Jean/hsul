<h2>Consulta de Orçamentos Declinados</h2>
<div>
  <fieldset class="filtros">
    <legend>Filtros de Pesquisa</legend>
    <form name="frmfiltrodeclinados" action="?pasta=orcamentos/&arq=hs_con_declinados_orcamentos&ext=php" method="post">
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
    $hs_sel_orcamentos = "SELECT orcamentos.id, clientes.nome, orcamentos.motivo FROM orcamentos INNER JOIN clientes ON orcamentos.clientes_id=clientes.id WHERE orcamentos.status='3'";

    if((isset($_POST['txtcodigo']))||(isset($_POST['txtnome']))||(isset($_POST['txtlogradouro']))){
      $hs_sel_orcamentos .= " AND";

     $p_codigo = $_POST['txtcodigo']; // coloca o post em uma variável para facilitar
     $hs_sel_orcamentos.=" orcamentos.id ='".$p_codigo."' AND"; //e completa a sintaxe

     $p_nome = $_POST['txtnome'];// coloca o post em uma variável para facilitar
     $hs_sel_orcamentos.=" clientes.nome LIKE '%".$p_nome."%' AND";//e completa a sintaxe

     $p_logradouro = $_POST['txtlogradouro'];// coloca o post em uma variável para facilitar
     $hs_sel_orcamentos.=" orcamentos.logradouro LIKE '%".$p_logradouro."%' AND";//e completa a sintaxe

     $hs_sel_orcamentos = substr($hs_sel_orcamentos, 0, -3); //substr para tirar os 3 ultimos itens que são o 'and'
     }
    $hs_sel_orcamentos_preparado = $conexaobd->prepare($hs_sel_orcamentos);
    $hs_sel_orcamentos_preparado->execute();
  ?>
  <table>
    <thead>
      <tr>
        <th width="18%">Código do orçamento</th>
        <th width="40%">Nome do cliente</th>
        <th width="20%">Motivo</th>
        <th width="7.33%">Reutilizar</th>
        <th width="7.33%">Visualizar</th>
        <th width="7.33%">Excluir</th>
      </tr>
    </thead>
    <tbody>
      <?php
        if($hs_sel_orcamentos_preparado->rowCount()>0){
          while($hs_sel_orcamentos_dados = $hs_sel_orcamentos_preparado->fetch()){

            switch ($hs_sel_orcamentos_dados['motivo']) {
              case 'FI':
                $motivo = 'Financeiro';
                break;
              case 'OM':
                $motivo = 'Oferta melhor';
                break;
              case 'PA':
                $motivo = 'Problemas com atendimento';
                break;
              case 'PF':
                $motivo = 'Problemas familiares';
                break;
              case 'NR':
                $motivo = 'Não houve retorno';
                break;
              case 'OU':
                $motivo = 'Outros';
                break;
            }

      ?>
      <tr>
        <td><?php echo $hs_sel_orcamentos_dados['id']?></td>
        <td><?php echo $hs_sel_orcamentos_dados['nome']?></td>
        <td><?php echo $motivo ?></td>
        <td><a href="?pasta=orcamentos/acoes/&arq=hs_fmreutilizar_orcamentos&ext=php&id=<?php echo $hs_sel_orcamentos_dados['id'] ?>"><i class="fa fa-check" aria-hidden="true"></i></a></td>
        <td><a href="?pasta=orcamentos/&arq=hs_con_det_orcamentos&ext=php&id=<?php echo $hs_sel_orcamentos_dados['id'] ?>"><i class="fa fa-search" aria-hidden="true"></i></a></td>
        <td><a title="Excluir registro"><?php echo confirmacao_exclusao($hs_sel_orcamentos_dados['id'], '', '?pasta=orcamentos/acoes/&arq=hs_del_orcamentos&ext=php', 'esse orçamento', $hs_sel_orcamentos_dados['id']);?></a></td>
      </tr>
      <?php
          }
        }else{
      ?>
      <tr>
        <td colspan="6" align="center">Não há registros.</td>
      </tr>
      <?php
        }
      ?>
    </tbody>
  </table>
</div>
