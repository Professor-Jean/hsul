<h2>Consulta de Serviços Realizados</h2>
<div>
<?php
    $hs_sel_orcamentos = "SELECT orcamentos.id, clientes.nome, orcamentos.data_inicio, orcamentos.data_conclusao FROM orcamentos INNER JOIN clientes ON orcamentos.clientes_id=clientes.id WHERE orcamentos.status='2' AND";

	if((isset($_POST['txtcodigo']))||(isset($_POST['txtnomecliente']))||(isset($_POST['txtdataconclusao']))){
		if(($_POST['txtcodigo']!="")||($_POST['txtnomecliente']!="")||($_POST['txtdataconclusao']!="")){
			if($_POST['txtcodigo']!=""){
				$p_codigo = $_POST['txtcodigo'];
				$hs_sel_orcamentos.= " orcamentos.id LIKE '".$p_codigo."%' AND";
			}
			if($_POST['txtnomecliente']!=""){
				$p_nome = $_POST['txtnomecliente'];
				$hs_sel_orcamentos.= " clientes.nome LIKE '".$p_nome."%' AND";
			}
			if($_POST['txtdataconclusao']!=""){
				$p_data_conclusao = $_POST['txtdataconclusao'];
				$data2 = explode("/", $p_data_conclusao);
				$datacerta2 = $data2['2']."-".$data2['1']."-".$data2['0'];
				$hs_sel_orcamentos.= " orcamentos.data_conclusao LIKE '%".$datacerta2."%' OR orcamentos.data_inicio LIKE '%".$datacerta2."%' AND";
			}
		}
	}

	$hs_sel_orcamentos = substr($hs_sel_orcamentos, 0, -3);

	$hs_sel_orcamentos_preparado = $conexaobd->prepare($hs_sel_orcamentos);

	$hs_sel_orcamentos_preparado->execute();

?>
  <fieldset class="filtros">
    <legend>Filtros de Pesquisa</legend>
	<form method="post" action="?pasta=orcamentos/&arq=hs_con_servicos_realizados&ext=php">
    <table>
      <tr>
        <td>Código do orçamento: </td>
        <td> <input text="text" name="txtcodigo" placeholder="Ex.: 000000"/> </td>
      </tr>
      <tr>
        <td>Nome do cliente: </td>
        <td> <input text="text" name="txtnomecliente" placeholder="Ex.: Ana Clara"/> </td>
      </tr>
  	  <tr>
        <td>Data: </td>
        <td> <input type="text" name="txtdataconclusao" id="datepicker" placeholder="DD/MM/AAAA" readonly/> </td>
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
  <table>
    <thead>
      <tr>
        <th width="20%">Código do orçamento</th>
        <th width="30">Nome do cliente</th>
        <th width="20%">Data do serviço</th>
        <th width="20%">Data de conclusão</th>
        <th width="10%">Visualizar</th>
      </tr>
    </thead>
    <tbody>
      <?php
        if($hs_sel_orcamentos_preparado->rowCount()>0){
          while($hs_sel_orcamentos_dados = $hs_sel_orcamentos_preparado->fetch()){
      ?>
      <tr>
        <td><?php echo $hs_sel_orcamentos_dados['id'];?></td>
        <td><?php echo $hs_sel_orcamentos_dados['nome'];?></td>
		<?php
		$data1 = explode("-", $hs_sel_orcamentos_dados['data_inicio']);
		$data2 = explode("-", $hs_sel_orcamentos_dados['data_conclusao']);
		?>
        <td><?php echo $data1[2]."/".$data1[1]."/".$data1[0];?></td>
        <td><?php echo $data2[2]."/".$data2[1]."/".$data2[0];?></td>
        <td style="text-align: center;"><a href="?pasta=orcamentos/&arq=hs_con_det_orcamentos&ext=php&id=<?php echo $hs_sel_orcamentos_dados['id'];?>"><i class="fa fa-search" aria-hidden="true"></i></a></td>
      </tr>
      <?php
          }
        }else{
      ?>
      <tr>
        <td colspan="5" align="center">Não há registros.</td>
      </tr>
      <?php
        }
      ?>
    </tbody>
  </table>
</div>
