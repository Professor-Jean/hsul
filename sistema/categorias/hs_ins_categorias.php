<?php

$p_categoria = $_POST['txtnome'];
$p_margem = $_POST['txtlucro'];
$p_descricao = $_POST['txtdescricao'];

  if($p_categoria==""){
      $msg = mensagensadm(1, "'Nome'");
    }else if($p_margem==""){
        $msg = mensagensadm(1, "'Margem de lucro'");
      }else{

        $hs_sel_categorias = "SELECT * FROM categorias WHERE nome='".$p_categoria."'";
        $hs_sel_categorias_preparado = $conexaobd->prepare($hs_sel_categorias);
        $hs_sel_categorias_preparado->execute();

        if($hs_sel_categorias_preparado->rowCount()==0){

          $tabela = "categorias";
          $dados = array(
            'nome'         => $p_categoria,
            'lucro_bruto'  => $p_margem,
            'descricao'    => $p_descricao
          );

          $hs_ins_categorias_resultado = adicionar($tabela, $dados);

          if($hs_ins_categorias_resultado){
            $msg = mensagensadm(3);
          }

        }else{
          $msg = mensagensadm(7, "categoria", "Essa");
        }
      }

?>
<section>
  <div class="mensagem">
    <h3><i class="fa fa-exclamation-circle" aria-hidden="true"></i></i>Aviso</h3>
    <p><?php echo $msg;?></p>
    <a href="?pasta=categorias/&arq=hs_fmins_categorias&ext=php">Voltar</a>
  </div>
</section>
