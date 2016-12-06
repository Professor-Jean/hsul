<?php
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
  $p_senha        = $_POST['pwdsenha'];

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
                                }else if($p_senha==""){
                                      $msg = mensagensadm(1, 'Senha');
                                  }else{
                                    $hs_sel_usuarios = "SELECT id FROM usuarios WHERE usuario='".$p_usuario."'";
                                    $hs_sel_usuarios_preparado = $conexaobd->prepare($hs_sel_usuarios);
                                    $hs_sel_usuarios_preparado->execute();

                                    if($hs_sel_usuarios_preparado->rowCount()==0){
                                      $hs_sel_funcionarios = "SELECT id FROM funcionarios WHERE email='".$p_email."'";
                                      $hs_sel_funcionarios_preparado = $conexaobd->prepare($hs_sel_funcionarios);
                                      $hs_sel_funcionarios_preparado->execute();

                                      if($hs_sel_funcionarios_preparado->rowCount()==0){
                                        $hash_senha = md5($salt.$p_senha);

                                        $tabela = "usuarios";

                                        $dados = array(
                                          'usuario'        => $p_usuario,
                                          'senha'          => $hash_senha,
                                          'permissao'      => $p_permissao
                                        );

                                        $hs_ins_usuarios_resultado = adicionar($tabela, $dados);

                                        $ultimo_id =  $conexaobd->lastInsertId();

                                        if($hs_ins_usuarios_resultado){
                                          $usuarios_id = $conexaobd->lastInsertId();
                                          $data = explode("/", $p_data);
                                          $data_nascimento = $data[2]."-".$data[1]."-".$data[0];

                                          $tabela = "funcionarios";

                                          $dados = array(
                                            'usuarios_id'       => $usuarios_id,
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

                                          $hs_ins_usuarios_resultados = adicionar($tabela, $dados);

                                          if($hs_ins_usuarios_resultados){
                                            $msg = mensagensadm(3);
                                          }else{
                                            $tabela = "usuarios";
                                            $condicao = "id='".$ultimo_id."'";
                                            $hs_del_usuarios_resultado = deletar($tabela, $condicao);
                                            $msg = mensagensadm(8, 'funcionário', 'o');
                                          }
                                        }else{
                                          $msg = mensagensadm(8, 'usuário', 'o');
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
    <a href="?pasta=funcionarios/registros/&arq=hs_fmins_funcionarios&ext=php">Voltar</a>
  </div>
</section>
