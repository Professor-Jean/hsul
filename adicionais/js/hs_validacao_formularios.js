function validarmarcas(){
	if(document.frmcadmarcas.txtnome.value==""){
		alert("Preencha o campo Nome.");
		document.frmcadmarcas.txtnome.focus();
		return false;
	}else if(document.frmcadmarcas.txtimagem.value==""){
        alert("selecione uma imagem.");
        document.frmcadmarcas.txtimagem.focus();
        return false;
  }
}

function validaraltmarcas(){
	if(document.frmaltmarcas.txtnome.value==""){
		alert("Preencha o campo Nome.");
		document.frmaltmarcas.txtnome.focus();
		return false;
	}else if(document.frmaltmarcas.txtimagem.value==""){
        alert("Selecione uma imagem.");
        document.frmaltmarcas.txtimagem.focus();
        return false;
  }
}

function validarprodutos(){
  if(document.frmcadprodutos.selcategoria.value==""){
    alert("Selecione uma categoria.");
    document.frmcadprodutos.selcategoria.focus();
    return false;
  }else if(document.frmcadprodutos.selmarca.value==""){
        alert("Selecione uma marca.");
        document.frmcadprodutos.selmarca.focus();
        return false;
      }else if(document.frmcadprodutos.txtnome.value==""){
            alert("Preencha o campo Nome.");
            document.frmcadprodutos.txtnome.focus();
            return false;
          }else if(document.frmcadprodutos.flimage.value==""){
                alert("Selecione uma imagem.");
                document.frmcadprodutos.flimage.focus();
                return false;
          }else if(document.frmcadprodutos.txtminima.value==""){
								alert("Preencha o campo Quantidade Minima.");
								document.frmcadprodutos.txtminima.focus();
								return false;
					}
        }

function validaraltprodutos(){
  if(document.frmaltprodutos.selcategoria.value==""){
    alert("Selecione uma categoria.");
    document.frmaltprodutos.selcategoria.focus();
    return false;
  }else if(document.frmaltprodutos.selmarca.value==""){
        alert("Selecione uma marca.");
        document.frmaltprodutos.selmarca.focus();
        return false;
      }else if(document.frmaltprodutos.txtnome.value==""){
            alert("Preencha o campo Nome.");
            document.frmaltprodutos.txtnome.focus();
            return false;
          }else if(document.frmaltprodutos.txtminima.value==""){
									alert("Preencha o campo Quantidade Minima.");
									document.frmaltprodutos.txtminima.focus();
									return false;
						}
        }

function validacaomoventrada(){
  if(document.frmcadentrada.selcategoria.value==""){
    alert("Selecione uma categoria.");
    document.frmcadentrada.selcategoria.focus();
    return false;
  }else if(document.frmcadentrada.selmarca.value==""){
        alert("Selecione uma marca.");
        document.frmcadentrada.selmarca.focus();
        return false;
      }else if(document.frmcadentrada.selprodutos_id.value==""){
            alert("Selecione um produto.");
            document.frmcadentrada.selprodutos_id.focus();
            return false;
					}else if(document.frmcadentrada.txtquantidade.value==""){
								alert("Preencha o campo Quantidade.");
								document.frmcadentrada.txtquantidade.focus();
								return false;
							}else if(document.frmcadentrada.txtvalorcompra.value==""){
										alert("Preencha o campo Valor unitário do produto.");
										document.frmcadentrada.txtvalorcompra.focus();
										return false;
									}else if(document.frmcadentrada.txtdataentrada.value==""){
												alert("Selecione uma data de entrada.");
												document.frmcadentrada.txtdataentrada.focus();
												return false;
									}
								}

function validarmovsaida(){
  if(document.frmcadmsaida.selcategoria.value==""){
    alert("Selecione uma categoria.");
    document.frmcadmsaida.selcategoria.focus();
    return false;
  }else if(document.frmcadmsaida.selmarca.value==""){
        alert("Selecione uma marca.");
        document.frmcadmsaida.selmarca.focus();
        return false;
      }else if(document.frmcadmsaida.selnome.value==""){
            alert("Selecione um produto.");
            document.frmcadmsaida.selnome.focus();
            return false;
					}else if(document.frmcadmsaida.txtquantidade.value==""){
								alert("Preencha o campo Quantidade.");
								document.frmcadmsaida.txtquantidade.focus();
								return false;
							}else if(document.frmcadmsaida.txtvalor.value==""){
										alert("Preencha o campo Valor de venda.");
										document.frmcadmsaida.txtvalor.focus();
										return false;
									}else if(document.frmcadmsaida.txtdatasaida.value==""){
												alert("Selecione uma data de saída.");
												document.frmcadmsaida.txtdatasaida.focus();
												return false;
									}
								}


function validarfuncionarios(){
	if(document.frmfuncionarios.txtnome.value==""){
		alert("Preencha o campo Nome completo.");
    document.frmfuncionarios.txtnome.focus();
    return false;
	}else if(document.frmfuncionarios.txtdata.value==""){
			alert("Preencha o campo Data de Nascimento.");
	    document.frmfuncionarios.txtdata.focus();
	    return false;
		}else if(document.frmfuncionarios.txtrg.value==""){
					alert("Preencha o campo RG.");
					document.frmfuncionarios.txtrg.focus();
					return false;
				}else if(document.frmfuncionarios.txtcpf.value==""){
							alert("Preencha o campo CPF.");
							document.frmfuncionarios.txtcpf.focus();
							return false;
					}else if(document.frmfuncionarios.txttelefone.value==""){
								alert("Preencha o campo Telefone.");
								document.frmfuncionarios.txttelefone.focus();
								return false;
						}else if(document.frmfuncionarios.txtemail.value==""){
									alert("Preencha o campo E-mail.");
									document.frmfuncionarios.txtemail.focus();
									return false;
							}else if(document.frmfuncionarios.txtcep.value==""){
										alert("Preencha o campo CEP.");
										document.frmfuncionarios.txtcep.focus();
										return false;
								}else if(document.frmfuncionarios.selestado.value==""){
											alert("Selecione um estado.");
											document.frmfuncionarios.selestado.focus();
											return false;
									}else if(document.frmfuncionarios.selcidade.value==""){
												alert("Selecione uma cidade.");
												document.frmfuncionarios.selcidade.focus();
												return false;
										}else if(document.frmfuncionarios.txtbairro.value==""){
													alert("Preencha o campo Bairro.");
													document.frmfuncionarios.txtbairro.focus();
													return false;
											}else if(document.frmfuncionarios.txtlogradouro.value==""){
														alert("Preencha o campo Logradouro.");
														document.frmfuncionarios.txtlogradouro.focus();
														return false;
												}else if(document.frmfuncionarios.txtresidencia.value==""){
															alert("Preencha o campo Número da residencia.");
															document.frmfuncionarios.txtresidencia.focus();
															return false;
													}else if(document.frmfuncionarios.txtcomplemento.value==""){
																alert("Preencha o campo Complemento.");
																document.frmfuncionarios.txtcomplemento.focus();
																return false;
														}else if(document.frmfuncionarios.selpermissao.value==""){
																	alert("Selecione uma permissão.");
																	document.frmfuncionarios.selpermissao.focus();
																	return false;
															}else if(document.frmfuncionarios.txtusuario.value==""){
																		alert("Preencha o campo Usuário.");
																		document.frmfuncionarios.txtusuario.focus();
																		return false;
																}else if(document.frmfuncionarios.pwdsenha.value==""){
																			alert("Preencha o campo Senha.");
																			document.frmfuncionarios.pwdsenha.focus();
																			return false;
					}
				}

function validarupdfuncionariosadm(){
	if(document.frmfuncionarios.txtnome.value==""){
		alert("Preencha o campo Nome completo.");
    document.frmfuncionarios.txtnome.focus();
    return false;
	}else if(document.frmfuncionarios.txtdata.value==""){
			alert("Preencha o campo Data de Nascimento.");
	    document.frmfuncionarios.txtdata.focus();
	    return false;
		}else if(document.frmfuncionarios.txtrg.value==""){
					alert("Preencha o campo RG.");
					document.frmfuncionarios.txtrg.focus();
					return false;
				}else if(document.frmfuncionarios.txtcpf.value==""){
							alert("Preencha o campo CPF.");
							document.frmfuncionarios.txtcpf.focus();
							return false;
					}else if(document.frmfuncionarios.txttelefone.value==""){
								alert("Preencha o campo Telefone.");
								document.frmfuncionarios.txttelefone.focus();
								return false;
						}else if(document.frmfuncionarios.txtemail.value==""){
									alert("Preencha o campo E-mail.");
									document.frmfuncionarios.txtemail.focus();
									return false;
							}else if(document.frmfuncionarios.txtcep.value==""){
										alert("Preencha o campo CEP.");
										document.frmfuncionarios.txtcep.focus();
										return false;
								}else if(document.frmfuncionarios.selestado.value==""){
											alert("Selecione um estado.");
											document.frmfuncionarios.selestado.focus();
											return false;
									}else if(document.frmfuncionarios.selcidade.value==""){
												alert("Selecione uma cidade.");
												document.frmfuncionarios.selcidade.focus();
												return false;
										}else if(document.frmfuncionarios.txtbairro.value==""){
													alert("Preencha o campo Bairro.");
													document.frmfuncionarios.txtbairro.focus();
													return false;
											}else if(document.frmfuncionarios.txtlogradouro.value==""){
														alert("Preencha o campo Logradouro.");
														document.frmfuncionarios.txtlogradouro.focus();
														return false;
												}else if(document.frmfuncionarios.txtresidencia.value==""){
															alert("Preencha o campo Número da residencia.");
															document.frmfuncionarios.txtresidencia.focus();
															return false;
													}else if(document.frmfuncionarios.txtcomplemento.value==""){
																alert("Preencha o campo Complemento.");
																document.frmfuncionarios.txtcomplemento.focus();
																return false;
														}else if(document.frmfuncionarios.selpermissao.value==""){
																	alert("Selecione uma permissão.");
																	document.frmfuncionarios.selpermissao.focus();
																	return false;
															}else if(document.frmfuncionarios.txtusuario.value==""){
																		alert("Preencha o campo Usuário.");
																		document.frmfuncionarios.txtusuario.focus();
																		return false;
					}
				}

				//VALIDAÇÃO DO REGISTRO DE CLIENTE FÍSICO
				 function validacaofisico(){
					 if(document.frmcadfisico.txtnome.value==""){
						 alert("Preencha o campo Nome completo.");
						 document.frmcadfisico.txtnome.focus();
					 	}else if(document.frmcadfisico.txtdata.value==""){
						 		alert("Selecione uma data de nascimento.");
								document.frmcadfisico.txtdata.focus();
					 		}else if(document.frmcadfisico.txtrg.value==""){
						 			alert("Preencha o campo RG.");
									document.frmcadfisico.txtrg.focus();
					 			}else if(document.frmcadfisico.txtcpf.value==""){
						 				alert("Preencha o campo CPF.");
										document.frmcadfisico.txtcpf.focus();
					 				}else if(document.frmcadfisico.txttelefone.value==""){
						 					alert("Preencha o campo Telefone.");
											document.frmcadfisico.txttelefone.focus();
					 					}else if(document.frmcadfisico.txtemail.value==""){
						 						alert("Preencha o campo E-mail.");
												document.frmcadfisico.txtemail.focus();
					 						}else if(document.frmcadfisico.txtcep.value==""){
						 							alert("Preencha o campo CEP.");
													document.frmcadfisico.txtcep.focus();
					 							}else if(document.frmcadfisico.selestado.value==""){
						 								alert("Selecione um estado.");
														document.frmcadfisico.selestado.focus();
					 								}else if(document.frmcadfisico.selcidade.value==""){
						 									alert("Selecione uma cidade.");
															document.frmcadfisico.selcidade.focus();
					 									}else if(document.frmcadfisico.txtbairro.value==""){
						 										alert("Preencha o campo Bairro.");
																document.frmcadfisico.txtbairro.focus();
					 										}else if(document.frmcadfisico.txtlogradouro.value==""){
						 											alert("Preencha o campo Logradouro.");
																	document.frmcadfisico.txtlogradouro.focus();
					 											}else if(document.frmcadfisico.txtnresidencia.value==""){
						 												alert("Preencha o campo Número da residência.");
																		document.frmcadfisico.txtnresidencia.focus();
					 												}else if(document.frmcadfisico.txtcomplemento.value==""){
						 													alert("Preencha o campo Complemento.");
																			document.frmcadfisico.txtcomplemento.focus();
																		}else{
																			return true;
																			}
																			return false;
																			}

				//VALIDAÇÃO DE ALTERAÇAO DE CLIENTE FÍSICO
				function validacaoaltfisico(){
					if(document.frmaltfisico.txtnome.value==""){
						alert("Preencha o campo Nome completo.");
						document.frmaltfisico.txtnome.focus();
					}else if(document.frmaltfisico.txtdata.value==""){
							 alert("Selecione uma data de nascimento.");
							 document.frmaltfisico.txtdata.focus();
						 }else if(document.frmaltfisico.txtrg.value==""){
								 alert("Preencha o campo RG.");
								 document.frmaltfisico.txtrg.focus();
							 }else if(document.frmaltfisico.txtcpf.value==""){
									 alert("Preencha o campo CPF.");
									 document.frmaltfisico.txtcpf.focus();
								 }else if(document.frmaltfisico.txttelefone.value==""){
										 alert("Preencha o campo Telefone.");
										 document.frmaltfisico.txttelefone.focus();
									 }else if(document.frmaltfisico.txtemail.value==""){
											 alert("Preencha o campo E-mail.");
											 document.frmaltfisico.txtemail.focus();
										 }else if(document.frmaltfisico.txtcep.value==""){
												 alert("Preencha o campo CEP.");
												 document.frmaltfisico.txtcep.focus();
											 }else if(document.frmaltfisico.selestado.value==""){
													 alert("Selecione um estado.");
													 document.frmaltfisico.selestado.focus();
												 }else if(document.frmaltfisico.selcidade.value==""){
														 alert("Selecione uma cidade.");
														 document.frmaltfisico.selcidade.focus();
													 }else if(document.frmaltfisico.txtbairro.value==""){
															 alert("Preencha o campo Bairro.");
															 document.frmaltfisico.txtbairro.focus();
														 }else if(document.frmaltfisico.txtlogradouro.value==""){
																 alert("Preencha o campo Logradouro.");
																 document.frmaltfisico.txtlogradouro.focus();
															 }else if(document.frmaltfisico.txtnresidencia.value==""){
																	 alert("Preencha o campo Número da residência.");
																	 document.frmaltfisico.txtnresidencia.focus();
																 }else if(document.frmaltfisico.txtcomplemento.value==""){
																		 alert("Preencha o campo Complemento.");
																		 document.frmaltfisico.txtcomplemento.focus();
																	 }else{
																		 return true;
																		 }
																		 return false;
																		 }

				//VALIDAÇÃO DO REGISTRO DE PESSOA JURÍDICA
				function validacaojuridico(){

					if(document.frmcadjuridico.txtrazao.value==""){
						alert("Preencha o campo Razão social.");
						document.frmcadjuridico.txtrazao.focus();
					}else if(document.frmcadjuridico.txtfantasia.value==""){
							 alert("Preencha o campo Nome fantasia.");
							 document.frmcadjuridico.txtfantasia.focus();
						 }else if(document.frmcadjuridico.txtatvprincipal.value==""){
								 alert("Preencha o campo Atividade principal.");
								 document.frmcadjuridico.txtatvprincipal.focus();
							 }else if(document.frmcadjuridico.txttelempresa.value==""){
									 alert("Preencha o campo Telefone da empresa.");
									 document.frmcadjuridico.txttelempresa.focus();
								 }else if(document.frmcadjuridico.txtemail.value==""){
										 alert("Preencha o campo E-mail da empresa.");
										 document.frmcadjuridico.txtemail.focus();
									 }else if(document.frmcadjuridico.txtcnpj.value==""){
											 alert("Preencha o campo CNPJ.");
											 document.frmcadjuridico.txtcnpj.focus();
										 }else if(document.frmcadjuridico.txtcep.value==""){
												 alert("Preencha o campo CEP.");
												 document.frmcadjuridico.txtcep.focus();
											 }else if(document.frmcadjuridico.selestado.value==""){
													 alert("Selecione um estado.");
													 document.frmcadjuridico.selestado.focus();
												 }else if(document.frmcadjuridico.selcidade.value==""){
														 alert("Selecione uma cidade.");
														 document.frmcadjuridico.selcidade.focus();
													 }else if(document.frmcadjuridico.txtbairro.value==""){
															 alert("Preencha o campo Bairro.");
															 document.frmcadjuridico.txtbairro.focus();
														 }else if(document.frmcadjuridico.txtlogradouro.value==""){
																 alert("Preencha o campo Logradouro.");
																 document.frmcadjuridico.txtlogradouro.focus();
															 }else if(document.frmcadjuridico.txtnempresa.value==""){
																	 alert("Preencha o campo Número da empresa.");
																	 document.frmcadjuridico.txtnempresa.focus();
																 }else if(document.frmcadjuridico.txtcomplemento.value==""){
																	 alert("Preencha o campo Complemento.");
																	 document.frmcadjuridico.txtcomplemento.focus();
																 }else if(document.frmcadjuridico.txtrepresentante.value==""){
																		alert("Preencha o campo Nome do representante.");
																		document.frmcadjuridico.txtrepresentante.focus();
																 }else if(document.frmcadjuridico.txttelrepresentante.value==""){
																	 alert("Preencha o campo Telefone do representante.");
																	 document.frmcadjuridico.txttelrepresentante.focus();
																	 }else{
																		 return true;
																		 }
																		 return false;
																		 }

//VALIDAÇÃO DO REGISTRO DE PESSOA JURÍDICA
function validacaoaltjuridico(){

	if(document.frmaltjuridico.txtrazao.value==""){
			alert("Preencha o campo Razão social.");
			document.frmaltjuridico.txtrazao.focus();
		}else if(document.frmaltjuridico.txtfantasia.value==""){
 				alert("Preencha o campo Nome fantasia.");
 				document.frmaltjuridico.txtfantasia.focus();
			}else if(document.frmaltjuridico.txtatvprincipal.value==""){
	 				alert("Preencha o campo Atividade principal.");
	 				document.frmaltjuridico.txtatvprincipal.focus();
 				}else if(document.frmaltjuridico.txttelempresa.value==""){
		 				alert("Preencha o campo Telefone da empresa.");
		 				document.frmaltjuridico.txttelempresa.focus();
	 				}else if(document.frmaltjuridico.txtemail.value==""){
			 					alert("Preencha o campo E-mail da empresa.");
			 					document.frmaltjuridico.txtemail.focus();
						 }else if(document.frmaltjuridico.txtcnpj.value==""){
								 alert("Preencha o campo CNPJ.");
								 document.frmaltjuridico.txtcnpj.focus();
							 }else if(document.frmaltjuridico.txtcep.value==""){
									 alert("Preencha o campo CEP.");
									 document.frmaltjuridico.txtcep.focus();
								 }else if(document.frmaltjuridico.selestado.value==""){
										 alert("Selecione um estado.");
										 document.frmaltjuridico.selestado.focus();
									 }else if(document.frmaltjuridico.selcidade.value==""){
											 alert("Selecione uma cidade.");
											 document.frmaltjuridico.selcidade.focus();
										 }else if(document.frmaltjuridico.txtbairro.value==""){
												 alert("Preencha o campo Bairro.");
												 document.frmaltjuridico.txtbairro.focus();
											 }else if(document.frmaltjuridico.txtlogradouro.value==""){
													 alert("Preencha o campo Logradouro.");
													 document.frmaltjuridico.txtlogradouro.focus();
												 }else if(document.frmaltjuridico.txtnempresa.value==""){
														 alert("Preencha o campo Número da empresa.");
														 document.frmaltjuridico.txtnempresa.focus();
													 }else if(document.frmaltjuridico.txtcomplemento.value==""){
														 alert("Preencha o campo Complemento.");
														 document.frmaltjuridico.txtcomplemento.focus();
													 }else if(document.frmaltjuridico.txtrepresentante.value==""){
															alert("Preencha o campo Nome do representante.");
															document.frmaltjuridico.txtrepresentante.focus();
													 }else if(document.frmaltjuridico.txttelrepresentante.value==""){
														 alert("Preencha o campo Telefone do representante.");
														 document.frmaltjuridico.txttelrepresentante.focus();
														 }else{
															 return true;
															 }
															 return false;
															 }


//VALIDAÇÃO DO REGISTRO DE CIDADE
function validacaocidade(){
	if(document.frmcadcidade.selestado.value==""){
			alert("Preencha o campo Estado.");
			document.frmcadcidade.selestado.focus();
		}else if(document.frmcadcidade.txtnome.value==""){
				alert("Preencha o campo Cidade.");
				document.frmcadcidade.txtnome.focus();
			}else{
				return true;
				}
				return false;
				}

//VALIDAÇÃO DA ALTERAÇÃO DE CIDADE
function validacaoaltcidade(){
	if(document.frmaltcidade.selestado.value==""){
			alert("Selecione um estado.");
			document.frmaltcidade.selestado.focus();
		}else if(document.frmaltcidade.txtnome.value==""){
				alert("Preencha o campo Cidade.");
				document.frmaltcidade.txtnome.focus();
			}else{
				return true;
				}
				return false;
				}

//COMEÇO DA VALIDAÇAO DE FOMULARIOS DO TIAGO

function validacaoestados(){
	if(document.frmcadestados.txtnome.value==""){
		alert("Preencha o campo Nome.");
    document.frmcadestados.txtnome.focus();
    return false;
	}
}

function validacaocategorias(){
	if(document.frmcadcategorias.txtnome.value==""){
		alert("Preencha o campo Nome.");
    document.frmcadcategorias.txtnome.focus();
    return false;
	}else if(document.frmcadcategorias.txtlucro.value==""){
			alert("Preencha o campo Margem de lucro.");
	    document.frmcadcategorias.txtlucro.focus();
	    return false;
				}
}

function validacaoorcamentos(){
	if(document.frmcadorcamentos.selclientes.value==""){
		alert("Selecione o Nome do Cliente.");
    document.frmcadorcamentos.selclientes.focus();
    return false;
	}else if(document.frmcadorcamentos.txtmaodeobra.value==""){
			alert("Preencha o campo Valor da mão de obra.");
	    document.frmcadorcamentos.txtmaodeobra.focus();
	    return false;
		}else if(document.frmcadorcamentos.txtdesconto.value==""){
					alert("Preencha o campo Desconto.");
					document.frmcadorcamentos.txtdesconto.focus();
					return false;
				}else if(document.frmcadorcamentos.txtdatadevalidade.value==""){
							alert("Selecione uma data de validade.");
							document.frmcadorcamentos.txtdatadevalidade.focus();
							return false;
					}else if(document.frmcadorcamentos.txtcep.value==""){
								alert("Preencha o campo CEP.");
								document.frmcadorcamentos.txtcep.focus();
								return false;
						}else if(document.frmcadorcamentos.selestado.value==""){
									alert("Selecione um estado.");
									document.frmcadorcamentos.selestado.focus();
									return false;
							}else if(document.frmcadorcamentos.selcidade.value==""){
										alert("Selecione uma cidade.");
										document.frmcadorcamentos.selcidade.focus();
										return false;
								}else if(document.frmcadorcamentos.txtbairro.value==""){
											alert("Preencha o campo Bairro.");
											document.frmcadorcamentos.txtbairro.focus();
											return false;
									}else if(document.frmcadorcamentos.txtlogradouro.value==""){
												alert("Preencha o campo Logradouro.");
												document.frmcadorcamentos.txtlogradouro.focus();
												return false;
										}else if(document.frmcadorcamentos.txtnumeroresidencia.value==""){
													alert("Preencha o campo Número da residência.");
													document.frmcadorcamentos.txtnumeroresidencia.focus();
													return false;
											}else if(document.frmcadorcamentos.txtcomplemento.value==""){
														alert("Preencha o campo Complemento.");
														document.frmcadorcamentos.txtcomplemento.focus();
														return false;
												}
				}

function validacao_confirmacao_orcamentos(){
	if(document.frmconforcamento.txtdata.value==""){
		alert("PSelecione uma data de início.");
    document.frmconforcamento.txtdata.focus();
    return false;
	}
}

//FIM DA VALIDAÇAO DE FOMULARIOS DO TIAGO
