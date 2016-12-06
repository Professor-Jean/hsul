<?php
  $p_nome = $_POST['txtnome'];
  $p_data = $_POST['txtdata'];
  $p_rg = $_POST['txtrg'];
  $p_cpf = $_POST['txtcpf'];
  $p_telefone = $_POST['txttelefone'];
  $p_email = $_POST['txtemail'];
  $p_cep = $_POST['txtcep'];
  $p_estado = $_POST['selestado'];
  $p_cidade = $_POST['selcidade'];
  $p_bairro = $_POST['txtbairro'];
  $p_logradouro = $_POST['txtlogradouro'];
  $p_nresidencia = $_POST['txtnresidencia'];
  $p_complemento = $_POST['txtcomplemento'];
  $p_observacoes = $_POST['txaobservacoes'];
  $data = explode("/", $p_data);

  if($p_nome==""){
      $msg = mensagensadm(1, 'Nome completo');
    }else if($p_data==""){
        $msg = mensagensadm(1, 'Data de nascimento');
      }else if($p_rg==""){
          $msg = mensagensadm(1, 'RG');
        }else if($p_cpf==""){
            $msg = mensagensadm(1, 'CPF');
          }else if($p_telefone==""){
                $msg = mensagensadm(1, 'Telefone');
              }else if(!validacaotelefone($p_telefone, 1, 15)){
                  $msg = mensagensadm(16, 'Telefone');
                }else if($p_email==""){
                    $msg = mensagensadm(1, 'E-mail');
                  }else if(!validacaoemail($p_email)){
                    $msg = mensagensadm(16, 'E-mail');
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
                                }else if($p_nresidencia==""){
                                    $msg = mensagensadm(1, 'Número da residência');
                                  }else if($p_complemento==""){
                                      $msg = mensagensadm(1, 'Complemento');
                                    }else{
                                      $hs_sel_fisico = "SELECT nome, email, rg, cpf FROM clientesfisicos INNER JOIN clientes ON clientesfisicos.clientes_id=clientes.id WHERE clientes.nome='".$p_nome."' OR clientesfisicos.rg= '".$p_rg."' OR clientesfisicos.cpf='".$p_cpf."' OR clientesfisicos.email = '".$p_email."'";
                                      $hs_sel_fisico_preparado = $conexaobd->prepare($hs_sel_fisico);
                                      $hs_sel_fisico_preparado->execute();

                                      if($hs_sel_fisico_preparado->rowCount()==0){

                                        $tabela = "clientes";
                                        $dados = array(
                                          'nome'          => $p_nome,
                                          'cep'           => $p_cep,
                                          'bairro'        => $p_bairro,
                                          'logradouro'    => $p_logradouro,
                                          'complemento'   => $p_complemento,
                                          'cidades_id'    => $p_cidade
                                        );

                                        $hs_ins_clientes_resultado = adicionar($tabela, $dados);

                                        if($hs_ins_clientes_resultado){

                                          $id_clientes = $conexaobd->lastInsertId();

                                          $tabela = "clientesfisicos";
                                          $dados = array(
                                            'data_nascimento'   => $data['2']."-".$data['1']."-".$data['0'],
                                            'rg'                => $p_rg,
                                            'cpf'               => $p_cpf,
                                            'telefone'          => $p_telefone,
                                            'email'             => $p_email,
                                            'numero_residencia' => $p_nresidencia,
                                            'clientes_id'       => $id_clientes
                                          );

                                          $hs_ins_fisico_resultado = adicionar($tabela, $dados);
                                          $msg = mensagensadm(3);
                                        }else{
                                          $msg = mensagensadm(9, 'Cliente');
                                        }
                                      }else{
                                        $msg = mensagensadm(19, 'Nome,  RG, CPF e E-mail');
                                      }
                                    }
                            ?>
<section>
  <div class="mensagem">
    <h3><i class="fa fa-exclamation-circle" aria-hidden="true"></i></i>Aviso</h3>
    <p><?php echo $msg; ?></p>
    <a href="?pasta=clientes/fisicos/registros/&arq=hs_fmins_fisicos&ext=php">Voltar</a>
  </div>
</section>
