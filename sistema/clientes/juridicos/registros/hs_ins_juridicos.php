<?php
  $p_razao = $_POST['txtrazao'];
  $p_nomef = $_POST['txtfantasia'];
  $p_atvprincipal = $_POST['txtatvprincipal'];
  $p_telempresa = $_POST['txttelempresa'];
  $p_email = $_POST['txtemail'];
  $p_cnpj = $_POST['txtcnpj'];
  $p_cep = $_POST['txtcep'];
  $p_estado = $_POST['selestado'];
  $p_cidade = $_POST['selcidade'];
  $p_bairro = $_POST['txtbairro'];
  $p_logradouro = $_POST['txtlogradouro'];
  $p_nempresa = $_POST['txtnempresa'];
  $p_complemento = $_POST['txtcomplemento'];
  $p_representante = $_POST['txtrepresentante'];
  $p_telrepresentante = $_POST['txttelrepresentante'];
  $p_observacoes = $_POST['txaobservacoes'];


  if($p_razao==""){
      $msg = mensagensadm(1, 'Razão social');
    }else if($p_nomef==""){
        $msg = mensagensadm(1, 'Nome fantasia');
      }else if($p_atvprincipal==""){
          $msg = mensagensadm(1, 'Atividade principal');
        }else if($p_telempresa==""){
            $msg = mensagensadm(1, 'Telefone da empresa');
          }else if($p_email==""){
            $msg = mensagensadm(1, 'E-mail da empresa');
            }else if(!validacaoemail($p_email)){
              $msg = mensagensadm(16, 'E-mail da empresa');
              }else if($p_cnpj==""){
                  $msg = mensagensadm(1, 'CNPJ');
                }else if(!validacaocnpj($p_cnpj)){
                    $msg = mensagensadm(16, 'CNPJ');
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
                              }else if($p_nempresa==""){
                                  $msg = mensagensadm(1, 'Número da empresa');
                                }else if($p_complemento==""){
                                      $msg = mensagensadm(1, 'Complemento');
                                    }else if($p_representante==""){
                                        $msg = mensagensadm(1, 'Nome do representante');
                                      }else if($p_telrepresentante==""){
                                          $msg = mensagensadm(1, 'Telefone do representante');
                                        }else{
                                            $hs_sel_juridico = "SELECT nome, email_empresa FROM clientesjuridicos INNER JOIN clientes ON clientesjuridicos.clientes_id=clientes.id WHERE clientesjuridicos.razao_social='".$p_razao."' OR clientes.nome='".$p_nomef."' OR clientesjuridicos.email_empresa='".$p_email."' OR clientesjuridicos.cnpj='".$p_cnpj."'";
                                            $hs_sel_juridico_preparado = $conexaobd->prepare($hs_sel_juridico);
                                            $hs_sel_juridico_preparado->execute();
                                            
                                            if($hs_sel_juridico_preparado->rowCount()==0){

                                              $tabela = "clientes";
                                              $dados = array(
                                                'nome'          => $p_nomef,
                                                'cep'           => $p_cep,
                                                'bairro'        => $p_bairro,
                                                'logradouro'    => $p_logradouro,
                                                'complemento'   => $p_complemento,
                                                'observacoes'   => $p_observacoes,
                                                'cidades_id'    => $p_cidade
                                              );

                                              $hs_ins_clientes_resultado = adicionar($tabela, $dados);

                                              if($hs_ins_clientes_resultado){

                                                $id_clientes = $conexaobd->lastInsertId();

                                                $tabela = "clientesjuridicos";
                                                $dados = array(
                                                  'razao_social'            => $p_razao,
                                                  'atividade_principal'     => $p_atvprincipal,
                                                  'telefone_empresa'        => $p_telempresa,
                                                  'email_empresa'           => $p_email,
                                                  'cnpj'                    => $p_cnpj,
                                                  'numero_empresa'          => $p_nempresa,
                                                  'nome_representante'      => $p_representante,
                                                  'telefone_representante'  => $p_telrepresentante,
                                                  'clientes_id'             => $id_clientes
                                                );

                                                $hs_ins_juridico_resultado = adicionar($tabela, $dados);
                                                $msg = mensagensadm(3);
                                              }else{
                                                $msg = mensagensadm(9, 'Cliente');
                                              }
                                            }else{
                                              $msg = mensagensadm(19, 'Nome fantasia, E-mail da empresa, Razão Social ou CNPJ');
                                            }
                                          }
   ?>
   <section>
     <div class="mensagem">
       <h3><i class="fa fa-exclamation-circle" aria-hidden="true"></i></i>Aviso</h3>
       <p><?php echo $msg; ?></p>
       <a href="?pasta=clientes/juridicos/registros/&arq=hs_fmins_juridicos&ext=php">Voltar</a>
     </div>
   </section>
