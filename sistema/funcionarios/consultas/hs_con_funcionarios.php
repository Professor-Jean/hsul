<h2>Consulta de Funcionário</h2>
<div>
  <fieldset class="filtros">
    <legend>Filtros de Pesquisa</legend>
    <form name="frmfiltrofuncionario" action="?pasta=funcionarios/consultas/&arq=hs_con_funcionarios&ext=php" method="post">
      <table>
        <tr>
          <td>Nome do funcionário: </td>
          <td> <input type="text" name="txtnome"/> </td>
        </tr>
        <tr>
          <td>Usuário: </td>
          <td> <input type="text" name="txtusuario"/> </td>
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
    $hs_sel_funcionarios = "SELECT funcionarios.nome_completo, usuarios.usuario, usuarios.permissao, funcionarios.id, funcionarios.usuarios_id FROM funcionarios INNER JOIN usuarios ON funcionarios.usuarios_id=usuarios.id";

    if((isset($_POST['txtnome']))||(isset($_POST['txtusuario']))){
     $hs_sel_funcionarios.=" WHERE ";

     $p_nome = $_POST['txtnome']; // coloca o post em uma variável para facilitar
     $hs_sel_funcionarios.=" funcionarios.nome_completo LIKE '%".$p_nome."%' AND"; //e completa a sintaxe

     $p_usuario = $_POST['txtusuario'];// coloca o post em uma variável para facilitar
     $hs_sel_funcionarios.=" usuarios.usuario LIKE '%".$p_usuario."%' AND";//e completa a sintaxe


     $hs_sel_funcionarios = substr($hs_sel_funcionarios, 0, -3); //substr para tirar os 3 ultimos itens que são o 'and'
     }
    $hs_sel_funcionarios_preparado = $conexaobd->prepare($hs_sel_funcionarios);
    $hs_sel_funcionarios_preparado->execute();
  ?>
  <table>
    <thead>
      <tr>
        <th width="40%">Nome completo</th>
        <th width="35%">Usuário</th>
        <th width="20%">Permissão</th>
        <th width="5%">Visualizar</th>
      </tr>
    </thead>
    <tbody>
      <?php
        if($hs_sel_funcionarios_preparado->rowCount()>0){
          while ($hs_sel_funcionarios_resultados = $hs_sel_funcionarios_preparado->fetch()){

            switch ($hs_sel_funcionarios_resultados['permissao']) {
              case 0:
                $permissao = "Administrador";
                break;
              case 1:
                $permissao = "Funcionário Financeiro";
                break;
              case 2:
                $permissao = "Funcionário Regular";
                break;
              default:
                $permissao = "Inválido";
                break;
            }
      ?>
      <tr>
        <td><?php echo $hs_sel_funcionarios_resultados['nome_completo']?></td>
        <td><?php echo $hs_sel_funcionarios_resultados['usuario']?></td>
        <td><?php echo $permissao ?></td>
        <td><a href="?pasta=funcionarios/consultas/&arq=hs_con_detfuncionarios&ext=php&funcionarios_id=<?php echo $hs_sel_funcionarios_resultados['id'] ?>&usuarios_id=<?php echo  $hs_sel_funcionarios_resultados['usuarios_id'] ?>"><i class="fa fa-search" aria-hidden="true"></i></a></td>
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
