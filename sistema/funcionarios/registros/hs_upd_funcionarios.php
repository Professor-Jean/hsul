<?php
  $p_funcionarios = $_POST['hidfuncionarios'];
  $p_usuarios     = $_POST['hidusuarios'];
  $p_nome         = $_POST['txtnome'];
  $p_data         = $_POST['txtdata'];
  $p_rg           = $_POST['txtrg'];
  $p_cpf          = $_POST['txtcpf'];
  $p_telefone     = $_POST['txttelefone'];
  $p_email        = $_POST['txtemail'];
  $p_cep          = $_POST['txtcep'];
  $p_estado       = $_POST['selestado'];
  $p_cidade       = $_POST['selcidade'];
  $p_bairro       = $_POST['txtbairro'];
  $p_logradouro   = $_POST['txtlogradouro'];
  $p_residencia   = $_POST['txtresidencia'];
  $p_complemento  = $_POST['txtcomplemento'];
  $p_observacoes  = $_POST['txaobservacoes'];
  $p_permissao    = $_POST['selpermissao'];
  $p_usuario      = $_POST['txtusuario'];

  $voltar = "?pasta=funcionarios/registros/&arq=hs_fmupd_funcionarios&ext=php&funcionarios_id=".$p_funcionarios."&usuarios_id=".$p_usuarios;

  if($p_nome==""){
      $msg = mensagensadm(1, 'Nome completo');
    }else if($p_data==""){
          $msg = mensagensadm(1, 'Data de Nascimento');
      }else if($p_rg==""){
            $msg = mensagensadm(1, 'RG');
        }else if($p_cpf==""){
              $msg = mensagensadm(1, 'CPF');
          }else if($p_telefone==""){
                $msg = mensagensadm(1, 'Telefone');
            }else if($p_email==""){
                  $msg = mensagensadm(1, 'E-mail');
              }else if($p_cep==""){
                    $msg = mensagensadm(1, 'CEP');
                }else if($p_estado==""){
                      $msg = mensagensadm(1, 'Estado');
                  }else if($p_cidade==""){
                        $msg = mensagensadm(1, 'Cidade');
                    }else if($p_bairro==""){
                          $msg = mensagensadm(1, 'Bairro');
                      }else if($p_logradouro==""){
                            $msg = mensagensadm(1, 'Logradouro');
                        }else if($p_residencia==""){
                              $msg = mensagensadm(1, 'Número da residencia');
                          }else if($p_complemento==""){
                                $msg = mensagensadm(1, 'Complemento');
                            }else if($p_permissao==""){
                                  $msg = mensagensadm(1, 'Permissão');
                              }else if($p_usuario==""){
                                    $msg = mensagensadm(1, 'Usuário');
                                }else{
                                  $hs_sel_usuarios = "SELECT id FROM usuarios WHERE usuario='".$p_usuario."' AND id<>'".$p_usuarios."'";
                                  $hs_sel_usuarios_preparado = $conexaobd->prepare($hs_sel_usuarios);
                                  $hs_sel_usuarios_preparado->execute();

                                  if($hs_sel_usuarios_preparado->rowCount()==0){
                                    $hs_sel_funcionarios = "SELECT id FROM funcionarios WHERE email='".$p_email."' AND id<>'".$p_funcionarios."'";
                                    $hs_sel_funcionarios_preparado = $conexaobd->prepare($hs_sel_funcionarios);
                                    $hs_sel_funcionarios_preparado->execute();

                                    if($hs_sel_funcionarios_preparado->rowCount()==0){

                                      $tabela = "usuarios";

                                      $dados = array(
                                        'usuario'        => $p_usuarios,
                                        'permissao'      => $p_permissao
                                      );

                                      $condicao = "id='".$p_usuarios."'";

                                      $hs_upd_usuarios_resultado = alterar($tabela, $dados, $condicao);

                                      if($hs_upd_usuarios_resultado){
                                        $data = explode("/", $p_data);
                                        $data_nascimento = $data[2]."-".$data[1]."-".$data[0];

                                        $tabela = "funcionarios";

                                        $dados = array(
                                          'usuarios_id'       => $p_usuarios,
                                          'cidades_id'        => $p_cidade,
                                          'nome_completo'     => $p_nome,
                                          'data_nascimento'   => $data_nascimento,
                                          'rg'                => $p_rg,
                                          'cpf'               => $p_cpf,
                                          'telefone'          => $p_telefone,
                                          'email'             => $p_email,
                                          'cep'               => $p_cep,
                                          'bairro'            => $p_bairro,
                                          'logradouro'        => $p_logradouro,
                                          'numero_residencia' => $p_residencia,
                                          'complemento'       => $p_complemento,
                                          'observacoes'       => $p_observacoes
                                        );

                                        $condicao = "id='".$p_funcionarios."'";

                                        $hs_upd_usuarios_resultado = alterar($tabela, $dados, $condicao);

                                        if($hs_upd_usuarios_resultado){
                                          $msg = mensagensadm(6, 'funcionário', 'de');
                                          $voltar = "?pasta=funcionarios/registros/&arq=hs_fmins_funcionarios&ext=php";
                                        }else{
                                          $msg = mensagensadm(2, 'funcionário');
                                        }
                                      }else{
                                        $msg = mensagensadm(2, 'usuário');
                                      }
                                    }else {
                                      $msg = mensagensadm(7, 'funcionário', 'Este');
                                    }
                                  }else{
                                    $msg = mensagensadm(7, 'usuário', 'Este');
                                  }
                                }
?>
<section>
  <div class="mensagem">
    <h3><i class="fa fa-exclamation-circle" aria-hidden="true"></i></i>Aviso</h3>
    <p><?php echo $msg;?></p>
    <a href="<?php echo $voltar;?>">Voltar</a>
  </div>
</section>
