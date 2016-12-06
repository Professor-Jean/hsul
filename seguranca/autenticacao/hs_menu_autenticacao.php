<?php
  function menupermissao($permissao){
    switch ($permissao) {
      case 0:
        $nav = '<ul class="dropdown">
          <li class="dropbtn"><i class="fa fa-caret-down" aria-hidden="true"></i> Registros </li>
          <ul class="dropdown-content">
            <a href="?pasta=localidades/estados/&arq=hs_fmins_estados&ext=php"><li>Registro de Estado</li></a>
            <a href="?pasta=localidades/cidades/&arq=hs_fmins_cidades&ext=php"><li>Registro de Cidade</li></a>
            <a href="?pasta=funcionarios/registros/&arq=hs_fmins_funcionarios&ext=php"><li>Registro de Funcionário</li></a>
            <a href="?pasta=clientes/fisicos/registros/&arq=hs_fmins_fisicos&ext=php"><li>Registro de Pessoa Física</li></a>
            <a href="?pasta=clientes/juridicos/registros/&arq=hs_fmins_juridicos&ext=php"><li>Registro de Pessoa Jurídica</li></a>
            <a href="?pasta=categorias/&arq=hs_fmins_categorias&ext=php"><li>Registro de Categoria de Produto</li></a>
            <a href="?pasta=marcas/&arq=hs_fmins_marcas&ext=php"><li>Registro de Marca de Produto</li></a>
            <a href="?pasta=produtos/registros/&arq=hs_fmins_produtos&ext=php"><li>Registro de Produto</li></a>
            <a href="?pasta=orcamentos/&arq=hs_fmins_orcamentos&ext=php"><li>Registro de Orçamento</li></a>
          </ul>
        </ul>
        <ul class="dropdown">
          <li class="dropbtn"><i class="fa fa-caret-down" aria-hidden="true"></i> Controles </li>
          <ul class="dropdown-content">
            <a href="?pasta=estoque/movimentacoes/&arq=hs_fmins_entradas&ext=php"><li>Movimentação de Entrada de Estoque</li></a>
            <a href="?pasta=estoque/movimentacoes/&arq=hs_fmins_saidas&ext=php"><li>Movimentação de Saída de Estoque</li></a>
            <a href="?pasta=orcamentos/acoes/&arq=hs_controle_orcamentos&ext=php"><li>Controle de Orçamento</li></a>
          </ul>
        </ul>
        <ul class="dropdown">
          <li class="dropbtn"><i class="fa fa-caret-down" aria-hidden="true"></i> Consultas </li>
          <ul class="dropdown-content">
            <a href="?pasta=funcionarios/consultas/&arq=hs_con_funcionarios&ext=php"><li>Consulta de Funcionários</li></a>
            <a href="?pasta=clientes/fisicos/consultas/&arq=hs_con_fisicos&ext=php"><li>Consulta de Pessoas Físicas</li></a>
            <a href="?pasta=clientes/juridicos/consultas/&arq=hs_con_juridicos&ext=php"><li>Consulta de Pessoas Jurídicas</li></a>
            <a href="?pasta=produtos/consultas/&arq=hs_con_produtos&ext=php"><li>Consulta de Produtos</li></a>
            <a href="?pasta=orcamentos/&arq=hs_con_aprovados_orcamentos&ext=php"><li>Consulta de Orçamentos Aprovados</li></a>
            <a href="?pasta=orcamentos/&arq=hs_con_declinados_orcamentos&ext=php"><li>Consulta de Orçamentos Declinados</li></a>
            <a href="?pasta=orcamentos/&arq=hs_con_servicos_realizados&ext=php"><li>Consulta de Serviços Realizados</li></a>
            <a href="?pasta=estoque/consultas/&arq=hs_con_estoque&ext=php"><li>Consulta de Estoque</li></a>
            <a href="?pasta=estoque/consultas/&arq=hs_rel_entrada&ext=php"><li>Relatório de Entrada de Estoque</li></a>
            <a href="?pasta=estoque/consultas/&arq=hs_rel_saida&ext=php"><li>Relatório de Saída de Estoque</li></a>
          </ul>
        </ul>';
        break;
      case 1:
        $nav = '<ul class="dropdown">
          <li class="dropbtn"><i class="fa fa-caret-down" aria-hidden="true"></i> Registros </li>
          <ul class="dropdown-content">
            <a href="?pasta=localidades/estados/&arq=hs_fmins_estados&ext=php"><li>Registro de Estado</li></a>
            <a href="?pasta=localidades/cidades/&arq=hs_fmins_cidades&ext=php"><li>Registro de Cidade</li></a>
            <a href="?pasta=clientes/fisicos/registros/&arq=hs_fmins_fisicos&ext=php"><li>Registro de Pessoa Física</li></a>
            <a href="?pasta=clientes/juridicos/registros/&arq=hs_fmins_juridicos&ext=php"><li>Registro de Pessoa Jurídica</li></a>
            <a href="?pasta=categorias/&arq=hs_fmins_categorias&ext=php"><li>Registro de Categoria de Produto</li></a>
            <a href="?pasta=marcas/&arq=hs_fmins_marcas&ext=php"><li>Registro de Marca de Produto</li></a>
            <a href="?pasta=produtos/registros/&arq=hs_fmins_produtos&ext=php"><li>Registro de Produto</li></a>
            <a href="?pasta=orcamentos/&arq=hs_fmins_orcamentos&ext=php"><li>Registro de Orçamento</li></a>
          </ul>
        </ul>
        <ul class="dropdown">
          <li class="dropbtn"><i class="fa fa-caret-down" aria-hidden="true"></i> Controles </li>
          <ul class="dropdown-content">
            <a href="?pasta=estoque/movimentacoes/&arq=hs_fmins_entradas&ext=php"><li>Movimentação de Entrada de Estoque</li></a>
            <a href="?pasta=estoque/movimentacoes/&arq=hs_fmins_saidas&ext=php"><li>Movimentação de Saída de Estoque</li></a>
            <a href="?pasta=orcamentos/acoes/&arq=hs_controle_orcamentos&ext=php"><li>Controle de Orçamento</li></a>
          </ul>
        </ul>
        <ul class="dropdown">
          <li class="dropbtn"><i class="fa fa-caret-down" aria-hidden="true"></i> Consultas </li>
          <ul class="dropdown-content">
            <a href="?pasta=clientes/fisicos/consultas/&arq=hs_con_fisicos&ext=php"><li>Consulta de Pessoas Físicas</li></a>
            <a href="?pasta=clientes/juridicos/consultas/&arq=hs_con_juridicos&ext=php"><li>Consulta de Pessoas Jurídicas</li></a>
            <a href="?pasta=produtos/consultas/&arq=hs_con_produtos&ext=php"><li>Consulta de Produtos</li></a>
            <a href="?pasta=orcamentos/&arq=hs_con_aprovados_orcamentos&ext=php"><li>Consulta de Orçamentos Aprovados</li></a>
            <a href="?pasta=orcamentos/&arq=hs_con_declinados_orcamentos&ext=php"><li>Consulta de Orçamentos Declinados</li></a>
            <a href="?pasta=orcamentos/&arq=hs_con_servicos_realizados&ext=php"><li>Consulta de Serviços Realizados</li></a>
            <a href="?pasta=estoque/consultas/&arq=hs_con_estoque&ext=php"><li>Consulta de Estoque</li></a>
            <a href="?pasta=estoque/consultas/&arq=hs_rel_entrada&ext=php"><li>Relatório de Entrada de Estoque</li></a>
            <a href="?pasta=estoque/consultas/&arq=hs_rel_saida&ext=php"><li>Relatório de Saída de Estoque</li></a>
          </ul>
        </ul>';
        break;
      case 2:
        $nav = '<ul class="dropdown">
          <li class="dropbtn"><i class="fa fa-caret-down" aria-hidden="true"></i> Registros </li>
          <ul class="dropdown-content">
            <a href="?pasta=localidades/estados/&arq=hs_fmins_estados&ext=php"><li>Registro de Estado</li></a>
            <a href="?pasta=localidades/cidades/&arq=hs_fmins_cidades&ext=php"><li>Registro de Cidade</li></a>
            <a href="?pasta=clientes/fisicos/registros/&arq=hs_fmins_fisicos&ext=php"><li>Registro de Pessoa Física</li></a>
            <a href="?pasta=clientes/juridicos/registros/&arq=hs_fmins_juridicos&ext=php"><li>Registro de Pessoa Jurídica</li></a>
            <a href="?pasta=categorias/&arq=hs_fmins_categorias&ext=php"><li>Registro de Categoria de Produto</li></a>
            <a href="?pasta=marcas/&arq=hs_fmins_marcas&ext=php"><li>Registro de Marca de Produto</li></a>
            <a href="?pasta=produtos/registros/&arq=hs_fmins_produtos&ext=php"><li>Registro de Produto</li></a>
            <a href="?pasta=orcamentos/&arq=hs_fmins_orcamentos&ext=php"><li>Registro de Orçamento</li></a>
          </ul>
        </ul>
        <ul class="dropdown">
          <li class="dropbtn"><i class="fa fa-caret-down" aria-hidden="true"></i> Controles </li>
          <ul class="dropdown-content">
            <a href="?pasta=orcamentos/acoes/&arq=hs_controle_orcamentos&ext=php"><li>Controle de Orçamento</li></a>
          </ul>
        </ul>
        <ul class="dropdown">
          <li class="dropbtn"><i class="fa fa-caret-down" aria-hidden="true"></i> Consultas </li>
          <ul class="dropdown-content">
            <a href="?pasta=clientes/fisicos/consultas/&arq=hs_con_fisicos&ext=php"><li>Consulta de Pessoas Físicas</li></a>
            <a href="?pasta=clientes/juridicos/consultas/&arq=hs_con_juridicos&ext=php"><li>Consulta de Pessoas Jurídicas</li></a>
            <a href="?pasta=produtos/consultas/&arq=hs_con_produtos&ext=php"><li>Consulta de Produtos</li></a>
            <a href="?pasta=orcamentos/&arq=hs_con_aprovados_orcamentos&ext=php"><li>Consulta de Orçamentos Aprovados</li></a>
            <a href="?pasta=orcamentos/&arq=hs_con_declinados_orcamentos&ext=php"><li>Consulta de Orçamentos Declinados</li></a>
            <a href="?pasta=orcamentos/&arq=hs_con_servicos_realizados&ext=php"><li>Consulta de Serviços Realizados</li></a>
            <a href="?pasta=estoque/consultas/&arq=hs_con_estoque&ext=php"><li>Consulta de Estoque</li></a>
          </ul>
        </ul>';
        break;
      default:
        $nav = '<ul class="dropdown">
                <li class="dropbtn"><i class="fa fa-caret-down" aria-hidden="true"></i> Registros </li>
              </ul>
              <ul class="dropdown">
                <li class="dropbtn"><i class="fa fa-caret-down" aria-hidden="true"></i> Controles </li>
              </ul>
              <ul class="dropdown">
                <li class="dropbtn"><i class="fa fa-caret-down" aria-hidden="true"></i> Consultas </li>
              </ul>';
        break;
      }

      return $nav;

    }
?>
