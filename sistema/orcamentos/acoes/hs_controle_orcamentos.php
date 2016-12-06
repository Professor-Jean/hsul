<h2> Controle de Orçamentos </h2>
<div>
  <div class="instrucao">
    <fieldset>
      <legend>Legenda</legend>
      <table>
        <tbody>
          <tr>
            <td align="center"><a><i class="fa fa-check" aria-hidden="true"></i></a></td>
            <td>Aprovar</td>
          </tr>
          <tr>
            <td align="center"><a><i class="fa fa-ban" aria-hidden="true"></i></a></td>
            <td>Declinar</td>
          </tr>
          <tr>
            <td align="center"><a><i class="fa fa-truck" aria-hidden="true"></i></a></td>
            <td>Concluir</td>
          </tr>
          <tr>
            <td align="center"><a><i class="fa fa-search" aria-hidden="true"></i></a></td>
            <td>Visualizar</td>
          </tr>
          <tr>
            <td align="center"><a><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
            <td>Editar</td>
          </tr>
        </tbody>
      </table>
    </fieldset>
  </div>
  <?php
    $hs_sel_orcamentos = "SELECT orcamentos.*, clientes.id AS id_cliente, clientes.nome AS nome_cliente FROM orcamentos INNER JOIN clientes ON orcamentos.clientes_id=clientes.id WHERE orcamentos.status<'2'  AND";

	if((isset($_POST['txtcodigo']))||(isset($_POST['txtnomecliente']))||(isset($_POST['txtlogradouro']))||(isset($_POST['txtdata']))){
		if(($_POST['txtcodigo']!="")||($_POST['txtnomecliente']!="")||($_POST['txtlogradouro']!="")||($_POST['txtdata']!="")){
			if($_POST['txtcodigo']!=""){
				$p_codigo = $_POST['txtcodigo'];
				$hs_sel_orcamentos.= " orcamentos.id LIKE '".$p_codigo."%' AND";
			}
			if($_POST['txtnomecliente']!=""){
				$p_nome = $_POST['txtnomecliente'];
				$hs_sel_orcamentos.= " clientes.nome LIKE '".$p_nome."%' AND";
			}
			if($_POST['txtlogradouro']!=""){
				$p_logradouro = $_POST['txtlogradouro'];
				$hs_sel_orcamentos.= " orcamentos.logradouro LIKE '".$p_logradouro."%' AND";
			}
			if($_POST['txtdata']!=""){
				$p_data = $_POST['txtdata'];
				$data = explode("/", $p_data);
				$datacerta = $data['2']."-".$data['1']."-".$data['0'];
				$hs_sel_orcamentos.= " orcamentos.data_validade LIKE '%".$datacerta."%' OR orcamentos.data_inicio LIKE '%".$datacerta."%' OR orcamentos.data_conclusao LIKE '%".$datacerta."%' AND";
			}
		}
	}

	$hs_sel_orcamentos = substr($hs_sel_orcamentos, 0, -3);

  $hs_sel_orcamentos .= " ORDER BY orcamentos.data_validade ASC";

	$hs_sel_orcamentos_preparado = $conexaobd->prepare($hs_sel_orcamentos);

	$hs_sel_orcamentos_preparado->execute();

?>

  <fieldset class="filtros">
    <legend>Filtros de Pesquisa</legend>
    <form method="post" action="?pasta=orcamentos/acoes/&arq=hs_controle_orcamentos&ext=php">
	<table>
      <tr>
        <td> Código do orçamentos: </td>
        <td> <input type="text" name="txtcodigo" placeholder="Ex.: 000000"/> </td>
      </tr>
      <tr>
        <td> Nome do Cliente: </td>
        <td> <input type="text" name="txtnomecliente" placeholder="Ex.: Ana Clara"/> </td>
      </tr>
      <tr>
        <td> Logradouro do serviço: </td>
        <td> <input type="text" name="txtlogradouro" placeholder="Ex.: Rua Inambú"/> </td>
      </tr>
      <tr>
        <td> Data do serviço: </td>
        <td> <input type="text" name="txtdata" id="datepicker" placeholder="DD/MM/AAAA" readonly/> </td>
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
  </fieldset>
</div>
<div class="consultas">
  <table>
    <thead>
      <tr>
        <th width="18%">Código do orçamento</th>
        <th width="20%">Nome do cliente</th>
        <th width="20%">Logradouro</th>
        <th width="12%">Telefone</th>
        <th width="15%">Data do Serviço</th>
        <th colspan="4" width="15%">Ações</th>
      </tr>
    </thead>
    <tbody>
	  <?php

	  if($hs_sel_orcamentos_preparado->rowCount()>0){
	    while ($hs_sel_orcamentos_dados = $hs_sel_orcamentos_preparado->fetch()){
      ?>
      <tr>
        <td><?php echo $hs_sel_orcamentos_dados['id']; ?></td>
        <td><?php echo $hs_sel_orcamentos_dados['nome_cliente']; ?></td>
        <td><?php echo $hs_sel_orcamentos_dados['logradouro']; ?></td>

        <!-- TELEFONE!-->
		<?php
		$hs_sel_clientesfiscos = "SELECT * FROM clientesfisicos WHERE clientes_id='".$hs_sel_orcamentos_dados['id_cliente']."'";
	    $hs_sel_clientesfiscos_preparado = $conexaobd->prepare($hs_sel_clientesfiscos);
	    $hs_sel_clientesfiscos_preparado->execute();
	    $hs_sel_clientesfiscos_dados = $hs_sel_clientesfiscos_preparado->fetch();

	    $hs_sel_clientesjuridicos = "SELECT * FROM clientesjuridicos WHERE clientes_id='".$hs_sel_orcamentos_dados['id_cliente']."'";
	    $hs_sel_clientesjuridicos_preparado = $conexaobd->prepare($hs_sel_clientesjuridicos);
	    $hs_sel_clientesjuridicos_preparado->execute();
	    $hs_sel_clientesjuridicos_dados = $hs_sel_clientesjuridicos_preparado->fetch();

		if($hs_sel_orcamentos_dados['id_cliente']==$hs_sel_clientesjuridicos_dados['clientes_id']){
		?>
		<td><?php echo preg_replace('/^(\d{2})(\d{4,5})(\d{4})$/', '($1) $2-$3', $hs_sel_clientesjuridicos_dados['telefone_representante']); ?></td>
		<?php }else{ ?>
		<td><?php echo preg_replace('/^(\d{2})(\d{4,5})(\d{4})$/', '($1) $2-$3', $hs_sel_clientesfiscos_dados['telefone']); ?></td>
		<?php } ?>
		<!-- FIM TELEFONE !-->

		<!-- DATA DO SERVIÇO !-->
		<?php
		$data = explode("-", $hs_sel_orcamentos_dados['data_validade']);
		$data1 = explode("-", $hs_sel_orcamentos_dados['data_inicio']);
		$data2 = explode("-", $hs_sel_orcamentos_dados['data_conclusao']);
		?>
		<?php if($hs_sel_orcamentos_dados['status']==1){ ?>
		<td><?php echo $data1[2]."/".$data1[1]."/".$data1[0];  ?></td>
		<?php }else if($hs_sel_orcamentos_dados['status']==2){ ?>
		<td><?php echo $data2[2]."/".$data2[1]."/".$data2[0];  ?></td>
		<?php }else{ ?>
		<td><?php echo $data[2]."/".$data[1]."/".$data[0]; ?></td>
		<?php } ?>
		<!-- FIM DATA DO SERVIÇO !-->

	  <!-- AÇÕES !-->
		<!-- confirmação e conclusão !-->
		<?php if($hs_sel_orcamentos_dados['status']==0){ ?>
        <td align="center"><a href="?pasta=orcamentos/acoes/&arq=hs_fmconfirmacao_orcamentos&ext=php&id=<?php echo $hs_sel_orcamentos_dados['id'];?>"><i class="fa fa-check" aria-hidden="true"></i></a></td>
		<?php }else if($hs_sel_orcamentos_dados['status']==3){ ?>
        <td align="center"><a href="?pasta=orcamentos/acoes/&arq=hs_fmconfirmacao_orcamentos&ext=php&id=<?php echo $hs_sel_orcamentos_dados['id'];?>"><i class="fa fa-check" aria-hidden="true"></i></a></td>
    <?php }else if(($hs_sel_orcamentos_dados['status']==1)&&($_SESSION['permissao']<>0)){ ?>
		    <td align="center"><i class="fa fa-truck unauthorized" aria-hidden="true"></i></td>
    <?php }else if(($hs_sel_orcamentos_dados['status']==1)&&($_SESSION['permissao']==0)){ ?>
		    <td align="center"><a href="?pasta=orcamentos/acoes/&arq=hs_fmconclusao_orcamentos&ext=php&id=<?php echo $hs_sel_orcamentos_dados['id'];?>"><i class="fa fa-truck" aria-hidden="true"></i></a></td>
		<?php } ?>

		<!-- declinar !-->
    <?php if($hs_sel_orcamentos_dados['status']<3){ ?>
        <td align="center"><a href="?pasta=orcamentos/acoes/&arq=hs_fmdeclinacao_orcamentos&ext=php&id=<?php echo $hs_sel_orcamentos_dados['id'];?>"><i class="fa fa-ban" aria-hidden="true"></i></a></td>
    <?php }else{ ?>
        <td align="center"><a><i class="fa fa-ban declined" aria-hidden="true"></i></a></td>
    <?php } ?>

		<!-- consulta detalhada !-->
        <td align="center"><a href="?pasta=orcamentos/&arq=hs_con_det_orcamentos&ext=php&id=<?php echo $hs_sel_orcamentos_dados['id'];?>"><i class="fa fa-search" aria-hidden="true"></i></a></td>

		<!-- alteração !-->
		<?php if($hs_sel_orcamentos_dados['status']==0){ ?>
        <td align="center"><a href="?pasta=orcamentos/acoes/&arq=hs_fmupd_orcamentos&ext=php&id=<?php echo $hs_sel_orcamentos_dados['id'];?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
		<?php }else if($hs_sel_orcamentos_dados['status']==3){ ?>
        <td align="center"><a href="?pasta=orcamentos/acoes/&arq=hs_fmupd_orcamentos&ext=php&id=<?php echo $hs_sel_orcamentos_dados['id'];?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
		<?php }else{ ?>
        <td align="center"><a><i class="fa fa-pencil confirmed" aria-hidden="true"></i></a></td>
		<?php } ?>
	  <!-- FIM AÇÕES !-->
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
