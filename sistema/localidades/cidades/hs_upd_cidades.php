<?php
$p_id = $_POST['hidid'];
$p_estado = $_POST['selestado'];
$p_nome = $_POST['txtnome'];
$caminho = "?pasta=localidades/cidades/&arq=hs_fmupd_cidades&ext=php&id=".$p_id;

if($p_estado==""){
    $msg = mensagensadm(1, 'Estado');
  }else if($p_nome==""){
      $msg = mensagensadm(1, 'Nome da cidade');
    }else{
        $hs_sel_cidades = "SELECT * FROM cidades WHERE nome='".$p_nome."' AND id<>'".$p_id."'";
        $hs_sel_cidades_preparado = $conexaobd->prepare($hs_sel_cidades);
        $hs_sel_cidades_preparado->execute();
        $hs_sel_cidades_dados = $hs_sel_cidades_preparado->fetch();

        if($hs_sel_cidades_preparado->rowCount()==0){
          $tabela = "cidades";
          $dados = array(
            'estados_id' => $p_estado,
            'nome'       => $p_nome
          );
          $condicao = "id='".$p_id."'";

          $hs_upd_cidades_resultado = alterar($tabela, $dados, $condicao);

          if($hs_upd_cidades_resultado){
              $caminho = "?pasta=localidades/cidades/&arq=hs_fmins_cidades&ext=php";
              $msg = mensagensadm(6, 'cidade', 'de');
            }else{
              $msg = mensagensadm(2, 'cidade');
            }

          }else{
            $msg = mensagensadm(7, 'Cidade');
          }
        }
?>
<section>
  <div class="mensagem">
    <h3><i class="fa fa-exclamation-circle" aria-hidden="true"></i></i>Aviso</h3>
    <p><?php echo $msg; ?></p>
    <a href="?pasta=localidades/cidades/&arq=hs_fmins_cidades&ext=php">Voltar</a>
  </div>
</section>
