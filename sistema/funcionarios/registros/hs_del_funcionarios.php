<?php
  $p_id = $_POST['id'];

  $hs_sel_funcionarios = "SELECT id FROM funcionarios";
  $hs_sel_funcionarios_preparado = $conexaobd->prepare($hs_sel_funcionarios);
  $hs_sel_funcionarios_preparado->execute();

  if($hs_sel_funcionarios_preparado->rowCount()==1){

    $msg = "Esse é o ultimo funcionário, impossível excluir";

  }else if (($p_id==md5('000001'))&&($_SESSION['idUsuario']<>'000001')){
      $msg = "Você não tem permissão de executar essa ação.";
    }else{

      $hs_sel_orcamentos = "SELECT id, usuarios_id FROM orcamentos WHERE MD5(funcionarios_id)='".$p_id."' AND status='0'";
      $hs_sel_orcamentos_preparado = $conexaobd->prepare($hs_sel_orcamentos);
      $hs_sel_orcamentos_preparado->execute();

      if($hs_sel_orcamentos_preparado->rowCount()>0){
        $msg = "Funcionário não pode ser excluido pois há orçamentos pendentes em seu nome.";
      }else{
        $tabela = "orcamentos";

        $dados = array(
          'funcionarios_id' => NULL
        );

        $condicao = "funcionarios_id='".$p_id."'";

        $hs_upd_orcamentos_resultado = alterar($tabela, $dados, $condicao);

        if($hs_upd_orcamentos_resultado){
          $hs_sel_funcionarios2 = "SELECT usuarios_id FROM funcionarios WHERE MD5(id)='".$p_id."'";
          $hs_sel_funcionarios2_preparado = $conexaobd->prepare($hs_sel_funcionarios2);
          $hs_sel_funcionarios2_preparado->execute();
          $hs_sel_funcionarios2_dados = $hs_sel_funcionarios2_preparado->fetch();

          $tabela = "funcionarios";

          $condicao = "MD5(id)='".$p_id."'";

          $hs_del_funcionarios_resultado = deletar($tabela, $condicao);

          if($hs_del_funcionarios_resultado){

            $tabela = "usuarios";

            $condicao = "id='".$hs_sel_funcionarios2_dados['usuarios_id']."'";

            $hs_del_usuarios_resultado = deletar($tabela, $condicao);

            if($hs_del_usuarios_resultado){
              $msg = mensagensadm(10, 'funcionário', 'de');

              if($p_id==md5($_SESSION['idUsuario'])){
                header('Location: ../seguranca/autenticacao/hs_logout_autenticacao.php');
              }
            }else{
              $msg = mensagensadm(11, 'usuário', 'de');
            }
          }else{
            $msg = mensagensadm(11, 'funcionário', 'de');
          }
        }else{
          $msg = "Erro ao desvincular orçamentos do funcionário.";
        }

      }
    }
?>
<section>
  <div class="mensagem">
    <h3><i class="fa fa-exclamation-circle" aria-hidden="true"></i></i>Aviso</h3>
    <p><?php echo $msg;?></p>
    <a href="?pasta=funcionarios/registros/&arq=hs_fmins_funcionarios&ext=php">Voltar</a>
  </div>
</section>
