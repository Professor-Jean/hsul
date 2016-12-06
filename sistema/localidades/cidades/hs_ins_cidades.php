<?php
$p_estado = $_POST['selestado'];
$p_nome = $_POST['txtnome'];
$msg = "errinho";
if($p_estado==""){
    $msg = mensagensadm(1, 'Estado');
  }else if($p_nome==""){
      $msg = mensagensadm(1, 'Nome da cidade');
    }else{

        $hs_sel_cidades = "SELECT cidades.nome AS cidade_nome, estados.nome AS estado_nome FROM cidades INNER JOIN estados WHERE cidades.estados_id=estados.id AND cidades.nome='".$p_nome."' AND cidades.estados_id='".$p_estado."'";
        $hs_sel_cidades_preparado = $conexaobd->prepare($hs_sel_cidades);
        $hs_sel_cidades_preparado->execute();

        if($hs_sel_cidades_preparado->rowCount()==0){
          $tabela = "cidades";
          $dados = array(
            'estados_id' => $p_estado,
            'nome'       => $p_nome,
          );

          $hs_ins_cidades_resultado = adicionar($tabela, $dados);

          if($hs_ins_cidades_resultado){
            $msg = mensagensadm(3);
          }
        }else{
          $msg = mensagensadm(7, 'cidade', 'Esta');
        }
      }
?>
<section>
  <div class="mensagem">
    <h3><i class="fa fa-exclamation-circle" aria-hidden="true"></i></i>Aviso</h3>
    <p><?php echo $msg;?></p>
    <a href="?pasta=localidades/cidades/&arq=hs_fmins_cidades&ext=php">Voltar</a>
  </div>
</section>
