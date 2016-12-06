 <h2> Registro de Orçamentos </h2>
  <div class="registros_orc">
    <form name="frmcadorcamentos" method="post" action="?pasta=orcamentos/&arq=hs_ins_orcamentos&ext=php" onsubmit="return validacaoorcamentos()">
      <?php
       $hs_sel_usuarios = "SELECT funcionarios.nome_completo AS nome, funcionarios.id AS id_funcionarios, usuarios.usuario, usuarios.id FROM usuarios INNER JOIN funcionarios ON funcionarios.usuarios_id=usuarios.id WHERE usuarios.id='".$_SESSION['idUsuario']."'";
       $hs_sel_usuarios_preparado = $conexaobd->prepare($hs_sel_usuarios);
       $hs_sel_usuarios_preparado->execute();
       $hs_sel_usuarios_dados = $hs_sel_usuarios_preparado->fetch();
      ?>
      <script>

      function valorProdutoIncorreto(){
        $("#valortotalprodutos").css({"background":"rgb(242, 36, 36)", "color":"#fff"});
        $("#valorTotalOrc").css({"background":"rgb(242, 36, 36)", "color":"#fff"});
      }
      function valorTotalIncorreto(){
        $("#valorTotalOrc").css({"background":"rgb(242, 36, 36)", "color":"#fff"});
      }

      function calcValorProd(){

        var produtos = document.getElementsByName('selprodutos[]');
        var quantidades = document.getElementsByName('txtquantidade[]');
        var produtosp = document.getElementsByName('selprodutosp[]');
        var quantidadesp = document.getElementsByName('txtquantindadep[]');

        var idp = Array();
        var idq = Array();

        for(i=0; i<produtos.length; i++){
          if(($(produtos[i]).val()!="")&&($(quantidades[i]).val()!="")){
            idp.push($(produtos[i]).val());
            idq.push($(quantidades[i]).val());
          }
        }
        for(i=0; i<produtosp.length; i++){
          if(($(produtosp[i]).val()!="")&&($(quantidadesp[i]).val()!="")){
            idp.push($(produtosp[i]).val());
            idq.push($(quantidadesp[i]).val());
          }
        }
        idp = JSON.stringify(idp);
        idq = JSON.stringify(idq);

        $.ajax({
          type: "post",
          url: "../adicionais/php/hs_valorproduto_php.php",
          data: {"idp":idp, "idq":idq},
        }).done(function(data){
          data = parseFloat(data).toFixed(2).replace(".",",");
          $("#valortotalprodutos").val("R$ "+data);
          $("#valortotalprodutos").css({"background":"rgb(90, 187, 97)"});
        });

      }

      function calcValorTotal(){
        valorProdTotal = parseFloat($("#valortotalprodutos").val().replace(",",".").replace("R$ ", ""));
        descontoOrc = parseFloat($("#descontoorc").val());
        maoDeObra = parseFloat($("#maodeobra").val());

        var total = valorProdTotal+maoDeObra-(valorProdTotal * descontoOrc / 100);
        total = parseFloat(total).toFixed(2).replace(".",",");
        $("#valorTotalOrc").val("R$ "+ total);
        $("#valorTotalOrc").css({"background":"rgb(90, 187, 97)"});
      }

      function mostraProdutosN(elemento){
        valorProdutoIncorreto();
        var index = $(elemento).parent().parent().attr('id').replace('id__', ''); //nessa linha se busca o elemento e acha ele por parent (é tipo um grau de parentesco, pois o elemento está dentro de uma tr que fica dentro de uma table), apos isso atribui um id__ dando valor 0 pra ele e conforme adicionado o tr esse valor aumenta.
        var categorias = document.getElementsByName('selcategorias[]'); //aqui é pego o valor do campo selcategorias[]
        var marcas = document.getElementsByName('selmarcas[]'); //aqui é pego o valor do campo selmarcas[]
        var produtos = document.getElementsByName('selprodutos[]'); //aqui é pego o valor do campo selprodutos[]

        var id_categoria = $(categorias[index]).val(); //a variavel id_categorias é criada e recebe novos valores conforme a criação de novas tr's, não mudando valores das tr's anteriores
        var id_marca = $(marcas[index]).val(); //a variavel id_marcas é criada e recebe novos valores conforme a criação de novas tr's, não mudando valores das tr's anteriores

        $(produtos[index]).html("<option>Aguarde</option>"); //a seleção produtos será gerado conforme o que foi selecionado em sua linha, não havendo interferencia de outra

        $.ajax({
          type: "post", //tipo de envio do arquivo
          url: "../adicionais/php/hs_buscadinamica_produtosnormais_php.php",//direciona os valores serão enviados
          data: {"id_marca":id_marca, "id_categoria":id_categoria},//dados que serão enviados enviados
        }).done(function(data){//envia os dados
          $(produtos[index]).html(data);
        });
      }

	  function mostraProdutosP(elemento){
      valorProdutoIncorreto();
      var index = $(elemento).parent().parent().attr('id').replace('id__', ''); //nessa linha se busca o elemento e acha ele por parent (é tipo um grau de parentesco, pois o elemento está dentro de uma tr que fica dentro de uma table), apos isso atribui um id__ dando valor 0 pra ele e conforme adicionado o tr esse valor aumenta.
      var categoriasp = document.getElementsByName('selcategoriasp[]'); //aqui é pego o valor do campo selcategoriasp[]
      var marcasp = document.getElementsByName('selmarcasp[]'); //aqui é pego o valor do campo selmarcasp[]
      var produtosp = document.getElementsByName('selprodutosp[]'); //aqui é pego o valor do campo selprodutosp[]

      var id_categoriap = $(categoriasp[index]).val(); //a variavel id_categorias é criada e recebe novos valores conforme a criação de novas tr's, não mudando valores das tr's anteriores
      var id_marcap = $(marcasp[index]).val(); //a variavel id_marcas é criada e recebe novos valores conforme a criação de novas tr's, não mudando valores das tr's anteriores

      $(produtosp[index]).html("<option>Aguarde</option>"); //a seleção produtos será gerado conforme o que foi selecionado em sua linha, não havendo interferencia de outra

      $.ajax({
        type: "post", //tipo de envio do arquivo
        url: "../adicionais/php/hs_buscadinamica_produtosdiversos_php.php",//direciona os valores serão enviados
        data: {"id_marcap":id_marcap, "id_categoriap":id_categoriap},//dados que serão enviados enviados
      }).done(function(data){//envia os dados
        $(produtosp[index]).html(data);
      });
    }

	  function mostraCidades(){

            id_estado = $('#selestado').val();

            $('#selcidade').html("<option>Aguarde</option>");

            $.post("../adicionais/php/hs_buscadinamica_php.php", {id:id_estado},
            function(dados){
                $('#selcidade').html(dados);
              }
            );
          }

      </script>
      <table>
		<tr>
		  <td colspan="2" align="center" style="padding-right: 120px;">Campos com (*) são obrigatórios.</td>
		</tr>
        <tr>
          <td> Nome do Funcionario: </td>
          <td> <input type="txt" name="txtfuncionario" readonly="readonly" value="<?php echo $hs_sel_usuarios_dados['nome'];?>"/></td>
        </tr>
        <tr>
          <td> *Nome do cliente: </td>
          <td>
            <select name="selclientes">
              <option value="">Selecione..</option>
              <?php

                $hs_sel_clientes = "SELECT * FROM clientes ORDER BY nome ASC";
                $hs_sel_clientes_preparado = $conexaobd->prepare($hs_sel_clientes);
                $hs_sel_clientes_preparado->execute();

                while($hs_sel_clientes_dados = $hs_sel_clientes_preparado->fetch()){

                    $id_clientes = $hs_sel_clientes_dados['id'];

                    $nome_clientes = $hs_sel_clientes_dados['nome'];

                    echo "<option value='".$id_clientes."'>".$nome_clientes."</option>";

                  }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <div class="mestre_detalhes_reg">
              <h5>Produtos</h5>
              <table>
                <tr>
                  <td>*Categoria:</td>
                  <td>*Marca:</td>
                  <td>*Nome do produto:</td>
                  <td>*Qntd. por produto:</td>
                  <td>
                    <a href="#" title="Adicionar itens" class="adicionarCampo"><i class="fa fa-plus" aria-hidden="true"></i></a>
                  </td>
                </tr>
                <tr class="linhas" id="id__0">
                  <td>
                    <select name="selcategorias[]" id="selcategorias" onchange="mostraProdutosN(this)">
                      <option value="">Selecione..</option>
                      <?php

                        $hs_sel_categorias = "SELECT categorias.nome, categorias.id FROM produtos LEFT JOIN categorias ON produtos.categorias_id=categorias.id INNER JOIN entradasestoque ON entradasestoque.produtos_id=produtos.id WHERE produtos.produtos_diversos='2' GROUP BY categorias.id";
                        $hs_sel_categorias_preparado = $conexaobd->prepare($hs_sel_categorias);
                        $hs_sel_categorias_preparado->execute();

                        while($hs_sel_categorias_dados = $hs_sel_categorias_preparado->fetch()){

                            $id_categorias = $hs_sel_categorias_dados['id'];

                            $nome_categorias = $hs_sel_categorias_dados['nome'];

                            echo "<option value='".$id_categorias."'>".$nome_categorias."</option>";

                          }
                      ?>
                    </select>
                  </td>
                  <td>
                    <select name="selmarcas[]" id="selmarcas" onchange="mostraProdutosN(this)">
                      <option value="">Selecione..</option>
                      <?php

                        $hs_sel_marcas = "SELECT marcas.nome, marcas.id FROM produtos LEFT JOIN marcas ON produtos.marcas_id=marcas.id INNER JOIN entradasestoque ON entradasestoque.produtos_id=produtos.id WHERE produtos.produtos_diversos='2' GROUP BY marcas.id";
                        $hs_sel_marcas_preparado = $conexaobd->prepare($hs_sel_marcas);
                        $hs_sel_marcas_preparado->execute();

                        while($hs_sel_marcas_dados = $hs_sel_marcas_preparado->fetch()){

                            $id_marcas = $hs_sel_marcas_dados['id'];

                            $nome_marcas = $hs_sel_marcas_dados['nome'];

                            echo "<option value='".$id_marcas."'>".$nome_marcas."</option>";

                          }
                      ?>
                    </select>
                  </td>
                  <td>
                    <select name="selprodutos[]" id="selprodutos_id">
                      <option value="">Selecione..</option>
                    </select>
                  </td>
                  <td><input type="txt" name="txtquantidade[]"></td>
                  <td>
                    <a href="#" title="Remover itens" class="removerCampo"><i class="fa fa-minus" aria-hidden="true"></i></a>
                  </td>
                </tr>
              </table>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <div class="mestre_detalhes_reg">
              <h5>Produtos Diversos:</h5>
              <table>
                <tr>
                  <td>Categoria:</td>
                  <td>Marca:</td>
                  <td>Nome do produto:</td>
                  <td>Qntd. por produto:</td>
                  <td>
                    <a href="#" title="Adicionar itens" class="adicionarCampodiversos"><i class="fa fa-plus" aria-hidden="true"></i></a>
                  </td>
                </tr>
                <tr class="linhasdiversos" id="id__0">
                  <td>
                    <select name="selcategoriasp[]" id="selcategoriasp" onchange="mostraProdutosP(this)">
                      <option value="">Selecione..</option>
                      <?php

                        $hs_sel_categorias = "SELECT categorias.nome, categorias.id FROM produtos LEFT JOIN categorias ON produtos.categorias_id=categorias.id INNER JOIN entradasestoque ON entradasestoque.produtos_id=produtos.id WHERE produtos.produtos_diversos='1' GROUP BY categorias.id";
                        $hs_sel_categorias_preparado = $conexaobd->prepare($hs_sel_categorias);
                        $hs_sel_categorias_preparado->execute();

                        while($hs_sel_categorias_dados = $hs_sel_categorias_preparado->fetch()){

                            $id_categorias = $hs_sel_categorias_dados['id'];

                            $nome_categorias = $hs_sel_categorias_dados['nome'];

                            echo "<option value='".$id_categorias."'>".$nome_categorias."</option>";

                          }
                      ?>
                    </select>
                  </td>
                  <td>
                    <select name="selmarcasp[]"  id="selmarcasp" onchange="mostraProdutosP(this)">
                      <option value="">Selecione..</option>
                      <?php

                        $hs_sel_marcas = "SELECT marcas.nome, marcas.id FROM produtos LEFT JOIN marcas ON produtos.marcas_id=marcas.id INNER JOIN entradasestoque ON entradasestoque.produtos_id=produtos.id WHERE produtos.produtos_diversos='1' GROUP BY marcas.id";
                        $hs_sel_marcas_preparado = $conexaobd->prepare($hs_sel_marcas);
                        $hs_sel_marcas_preparado->execute();

                        while($hs_sel_marcas_dados = $hs_sel_marcas_preparado->fetch()){

                            $id_marcas = $hs_sel_marcas_dados['id'];

                            $nome_marcas = $hs_sel_marcas_dados['nome'];

                            echo "<option value='".$id_marcas."'>".$nome_marcas."</option>";

                          }
                      ?>
                    </select>
                  </td>
                  <td>
                    <select name="selprodutosp[]" id="selprodutosp_id">
                      <option value="">Selecione..</option>
                    </select>
                  </td>
                  <td><input type="text" name="txtquantindadep[]"></td>
                  <td>
                    <a href="#" title="Remover itens" class="removerCampodiversos"><i class="fa fa-minus" aria-hidden="true"></i></a>
                  </td>
                </tr>
              </table>
            </div>
          </td>
        </tr>
        <tr>
          <td> Valor total produtos: </td>
          <td> <input id="valortotalprodutos" readonly="readonly" value="campo calculado"/> <button style="background-color: black; color: white; border-color: black; cursor: pointer;" type="button" onClick="calcValorProd()">Gerar</button></td>
        </tr>
        <tr>
          <td> *Valor da mão de obra: </td>
          <td> <input type="text" id="maodeobra" name="txtmaodeobra" maxlength="10" placeholder="000" onkeydown="valorTotalIncorreto()"/> </td>
        </tr>
        <tr>
          <td> *Desconto: </td>
          <td> <input type="text" id="descontoorc" name="txtdesconto" maxlength="7" placeholder="Porcentagem (ex.: 10)" onkeydown="valorTotalIncorreto()"/> </td>
        </tr>
        <tr>
          <td> Valor Total: </td>
          <td> <input id="valorTotalOrc" readonly="readonly" value="campo calculado"/> <button type="button" style="background-color: black; color: white; border-color: black; cursor: pointer;" onClick="calcValorTotal()">Gerar</button></td>
        </tr>
        <tr>
          <td> *Data de Validade: </td>
          <td> <input type="text" name="txtdatadevalidade" id="datepicker" placeholder="DD/MM/AAAA" readonly/> </td>
        </tr>
        <tr>
          <td> *CEP: </td>
          <td> <input type="text" name="txtcep" maxlength="10" placeholder="00000000"/> </td>
        </tr>
        <tr>
          <td> *Estado: </td>
          <td>
            <select name="selestado" id="selestado" onchange="mostraCidades()">
              <option value="">Selecione..</option>
              <?php

                $sql_sel_estados = "SELECT * FROM estados";

                $sql_sel_estados_preparado = $conexaobd->prepare($sql_sel_estados);

                $sql_sel_estados_preparado->execute();

                while($sql_sel_estados_dados = $sql_sel_estados_preparado->fetch()){

                    $id_estados = $sql_sel_estados_dados['id'];

                    $nome_estados = $sql_sel_estados_dados['nome'];

                    echo "<option value='".$id_estados."'>".$nome_estados."</option>";

                  }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td> *Cidade: </td>
          <td>
            <select name="selcidade" id="selcidade">
              <option value="">Selecione..</option>
            </select>
          </td>
        </tr>
        <tr>
          <td> *Bairro: </td>
          <td> <input type="text" name="txtbairro" maxlength="30" placeholder="Costa e Silva"/> </td>
        </tr>
        <tr>
          <td> *Logradouro: </td>
          <td> <input type="text" name="txtlogradouro" maxlength="60" placeholder="Rua Marquês de Olinda"/> </td>
        </tr>
        <tr>
          <td> *Número da residência: </td>
          <td> <input type="text" name="txtnumeroresidencia" maxlength="5" placeholder="0000"/> </td>
        </tr>
        <tr>
          <td> *Complemento: </td>
          <td> <input type="text" name="txtcomplemento" maxlength="20" placeholder="Casa"/> </td>
        </tr>
        <tr>
          <td> Comentário: </td>
          <td> <textarea type="text" name="txtcomentario"></textarea> </td>
        </tr>
        <tr align="center">
          <td colspan="2">
            <button type="reset">Limpar</button>
            <button type="submit" class="teste">Salvar</button>
          </td>
        </tr>
      </table>
    </form>
  </div>
