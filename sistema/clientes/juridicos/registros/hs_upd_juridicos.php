<?php
  $p_juridicos_id = $_POST['hidjuridicosid'];
  $p_clientes_id = $_POST['hidclientesid'];
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
  $caminho = "?pasta=clientes/juridicos/registros/&arq=hs_fmupd_juridicos&ext=php&juridicos_id=".$p_juridicos_id."&clientes_id=".$p_clientes_id;

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
                                                $hs_sel_juridicos = "SELECT clientes.id AS clientes_id, clientesjuridicos.id AS juridicos_id FROM clientesjuridicos INNER JOIN clientes ON clientesjuridicos.clientes_id=clientes.id WHERE clientesjuridicos.razao_social='".$p_razao."' OR clientes.nome='".$p_nomef."' OR clientesjuridicos.email_empresa='".$p_email."' OR clientesjuridicos.cnpj='".$p_cnpj."'";
                                                $hs_sel_juridicos_preparado = $conexaobd->prepare($hs_sel_juridicos);
                                                $hs_sel_juridicos_preparado->execute();
                                                $hs_sel_juridicos_dados = $hs_sel_juridicos_preparado->fetch();

                                                if($hs_sel_juridicos_preparado->rowCount()==1){

                                                  $tabela = "clientes";
                                                  $dados = array(
                                                    'cidades_id'   => $p_cidade,
                                                    'nome'         => $p_nomef,
                                                    'cep'          => $p_cep,
                                                    'bairro'       => $p_bairro,
                                                    'logradouro'   => $p_logradouro,
                                                    'complemento'  => $p_complemento,
                                                    'observacoes'  => $p_observacoes
                                                  );
                                                  $condicao = "id='".$p_clientes_id."'";

                                                  $hs_upd_clientes_resultado = alterar($tabela, $dados, $condicao);

                                                  if($hs_upd_clientes_resultado){
                                                    $tabela = "clientesjuridicos";
                                                    $dados = array(
                                                      'razao_social'            => $p_razao,
                                                      'atividade_principal'     => $p_atvprincipal,
                                                      'telefone_empresa'        => $p_telempresa,
                                                      'email_empresa'           => $p_email,
                                                      'cnpj'                    => $p_cnpj,
                                                      'numero_empresa'          => $p_nempresa,
                                                      'nome_representante'      => $p_representante,
                                                      'telefone_representante'  => $p_telrepresentante
                                                    );
                                                    $condicao = "id='".$p_juridicos_id."'";

                                                    $hs_upd_juridicos_resultado = alterar($tabela, $dados, $condicao);

                                                  if($hs_upd_juridicos_resultado){
                                                      $caminho = "?pasta=clientes/juridicos/registros/&arq=hs_fmins_juridicos&ext=php";
                                                      $msg = mensagensadm(6, "'Cliente juridico'", 'de');
                                                    }else{
                                                      $msg = mensagensadm(2, 'cliente juridico');
                                                    }

                                                  }else{
                                                    $msg = mensagensadm(7, 'Cliente juridico');
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
    <a href="<?php echo $caminho; ?>">Voltar</a>
  </div>
</section>
