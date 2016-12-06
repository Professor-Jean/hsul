<?php

$p_id = $_POST['hidid'];
$p_nome = $_POST['txtnome'];
$p_lucro = $_POST['txtlucro'];
$p_descricao = $_POST['txtdescricao'];

$saidas = "?pasta=categorias/&arq=hs_fmupd_categorias&ext=php&id=".$p_id."";

 if($p_nome==""){
    $msg = mensagensadm(1, "'Nome'");
  }else if($p_lucro==""){
     $msg = mensagensadm(1, "'Margem de lucro'");
   }else{

      $hs_sel_cetegorias = "SELECT * FROM categorias WHERE nome='".$p_nome."' id<>'".$p_id."'";
      $hs_sel_cetegorias_preparado = $conexaobd->prepare($hs_sel_cetegorias);
      $hs_sel_cetegorias_preparado->execute();
      $hs_sel_cetegorias_dados = $hs_sel_cetegorias_preparado->fetch();

      if($hs_sel_cetegorias_preparado->rowCount()==0){

        $tabela = "categorias";

        $dados = array(
          'nome'        => $p_nome,
          'lucro_bruto' => $p_lucro,
          'descricao' => $p_descricao
        );

        $condicao = "id= '".$p_id."'";
        $hs_upd_categorias_resultado = alterar($tabela, $dados, $condicao);

        if($hs_upd_categorias_resultado){
          $msg = mensagensadm(6,'categoria', 'de');
		      $saidas = "?pasta=categorias/&arq=hs_fmins_categorias&ext=php";
        }else{
          $msg = mensagensadm(2, 'categoria');
        }
      }else{
         $msg = mensagensadm(7, 'categoria', 'Esse');
      }
    }
?>

<section>
  <div class="mensagem">
    <h3><i class="fa fa-exclamation-circle" aria-hidden="true"></i></i>Aviso</h3>
    <p><?php echo $msg;?></p>
    <a href="<?php echo $saidas;?>">Voltar</a>
  </div>
</section>
