<?php
  $g_cidades_id = $_GET['id'];

  $hs_sel_cidades = "SELECT cidades.id AS id_cidade, cidades.nome AS nome_cidade, estados.id AS id_estados FROM cidades INNER JOIN estados ON cidades.estados_id=estados.id WHERE cidades.id='".$g_cidades_id."'";
  $hs_sel_cidades_preparado = $conexaobd->prepare($hs_sel_cidades);
  $hs_sel_cidades_preparado->execute();
  $hs_sel_cidades_dados = $hs_sel_cidades_preparado->fetch();

?>
<h2>Registro de Cidade</h2>
<div>
  <div class="registros">
    <form name="frmaltcidade" method="POST" action="?pasta=localidades/cidades/&arq=hs_upd_cidades&ext=php" onsubmit="return validacaoaltcidade()">
        <input type="hidden" name="hidid" value="<?php echo $hs_sel_cidades_dados['id_cidade']; ?>">
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
            $hs_sel_estados = "SELECT * FROM estados GROUP BY nome";
            $hs_sel_estados_preparado = $conexaobd->prepare($hs_sel_estados);
            $hs_sel_estados_preparado->execute();

              while($hs_sel_estados_dados = $hs_sel_estados_preparado->fetch()){

                $id_estados = $hs_sel_estados_dados['id'];
                $nome_estados = $hs_sel_estados_dados['nome'];

                if($id_estados==$hs_sel_cidades_dados['id_estados']){
                  echo "<option selected value='".$id_estados."'>".$nome_estados."</option>";
                }else{
                  echo "<option value='".$id_estados."'>".$nome_estados."</option>";
                }

              }
            ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>*Nome da cidade:</td>
        <td> <input type="text" name="txtnome" value="<?php echo $hs_sel_cidades_dados['nome_cidade']; ?>"> </td>
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
  </div>
</div>
