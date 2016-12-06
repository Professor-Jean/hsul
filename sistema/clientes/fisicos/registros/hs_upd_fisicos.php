<?php
  $p_fisicos_id = $_POST['hidfisicosid'];
  $p_clientes_id = $_POST['hidclientesid'];
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
  $caminho = "?pasta=clientes/fisicos/registros/&arq=hs_fmupd_fisicos&ext=php&fisicos_id=".$p_fisicos_id."&clientes_id=".$p_clientes_id;

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
                                      $hs_sel_fisicos = "SELECT nome, email, rg, cpf FROM clientesfisicos INNER JOIN clientes ON clientesfisicos.clientes_id=clientes.id WHERE clientes.nome='".$p_nome."' OR clientesfisicos.rg= '".$p_rg."' OR clientesfisicos.cpf='".$p_cpf."' OR clientesfisicos.email = '".$p_email."'";
                                      $hs_sel_fisicos_preparado = $conexaobd->prepare($hs_sel_fisicos);
                                      $hs_sel_fisicos_preparado->execute();

                                      $hs_sel_fisicos_dados = $hs_sel_fisicos_preparado->fetch();

                                      if($hs_sel_fisicos_preparado->rowCount()==1){
                                        $tabela = "clientes";
                                        $dados = array(
                                          'cidades_id'   => $p_cidade,
                                          'nome'         => $p_nome,
                                          'cep'          => $p_cep,
                                          'bairro'       => $p_bairro,
                                          'logradouro'   => $p_logradouro,
                                          'complemento'  => $p_complemento,
                                          'observacoes'  => $p_observacoes
                                        );
                                        $condicao = "id='".$p_clientes_id."'";

                                        $hs_upd_clientes_resultado = alterar($tabela, $dados, $condicao);

                                        if($hs_upd_clientes_resultado){
                                          $tabela = "clientesfisicos";
                                          $dados = array(
                                            'data_nascimento'    => $data['2']."-".$data['1']."-".$data['0'],
                                            'rg'                 => $p_rg,
                                            'cpf'                => $p_cpf,
                                            'telefone'           => $p_telefone,
                                            'email'              => $p_email,
                                            'numero_residencia'  => $p_nresidencia
                                          );
                                          $condicao = "id='".$p_fisicos_id."'";

                                          $hs_upd_fisicos_resultado = alterar($tabela, $dados, $condicao);

                                        if($hs_upd_fisicos_resultado){
                                            $caminho = "?pasta=clientes/fisicos/registros/&arq=hs_fmins_fisicos&ext=php";
                                            $msg = mensagensadm(6, "'Cliente físicos'", 'de');
                                          }else{
                                            $msg = mensagensadm(2, 'cliente físico');
                                          }

                                        }else{
                                          $msg = mensagensadm(2, 'cliente');
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
    <a href="<?php echo $caminho; ?>">Voltar</a>
  </div>
</section>
