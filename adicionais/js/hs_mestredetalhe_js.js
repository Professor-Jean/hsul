$(function () {

	function removeCampo(){
		$(".removerCampo").unbind("click");//estava "desativado"
		$(".removerCampo").bind("click", function (){//a partir dessa linha com um click se ativa a function
			if($("tr.linhas").length > 1){//se o numero de linhas for maior que 1
				$(this).parent().parent().remove();//ele vai remover a linha selecionada
			}else{
				alert("A última linha não pode ser removida.");
			}
		});
	}

	$(".adicionarCampo").click(function (){
		novoCampo = $("tr.linhas:first").clone(); //clona linha
		novoCampo.find("input").val(""); //dar valores zero para cada input
		var idAnterior = parseInt($("tr.linhas:last").attr('id').replace('id__', ''));//atribui id com valor inteiro para a ultima linha adicionada.
		var idAtual = idAnterior+1; //valor da linha atual é mais ul da anterior
		novoCampo.attr('id', 'id__'+idAtual); //da o valor da linha adicionada ex.:1, 2,..., 8.
		novoCampo.insertAfter("tr.linhas:last"); //inseri a nova linha a partir da linha anterior
		removeCampo(); //nessa linha se é chamada a function removeCampo()
	});

});

 function validaDetalhe(){
   //recebe os valores preenchidos das marca
   var categoriaValidar = document.getElementsByName('selcategorias[]');
   //recebe os valores preenchidos das categorias
   var marcaValidar   = document.getElementsByName('selmarcas[]');
   //recebe os valores preenchidos dos produtos
   var produtoValidar = document.getElementsByName('selprodutos[]');
   //recebe os valores preenchidos dos produtos
   var quantidadeValidar = document.getElementsByName('txtquantidade[]');
   //estrutura para-faça para repetir a validação enquanto contadora for menor que tamanho do array, sendo que contadora começa de 0 e tem incremento 1
   for(var contadora = 0; contadora < categoriaValidar.length; contadora++){
     //cria variável linha com valor de contadora +1 para a mensagem avisar corretamente qual campo não foi preenchido
     var linha = contadora+1;
     //se a posição atual dos arrays de categoria ou produto estiverem vazios
     if((categoriaValidar[contadora].value=="")||(marcaValidar[contadora].value=="")||(produtoValidar[contadora].value=="")||(quantidadeValidar[contadora].value=="")){
       alert("A linha "+linha+" não foi totalmente preenchida.");
       return false;
     }
   }
 }








 //PRODUTOS DIVERSOS

$(function (){

function removeCampodiversos(){
	$(".removerCampodiversos").unbind("click");//estava "desativado"
	$(".removerCampodiversos").bind("click", function (){//a partir dessa linha com um click se ativa a function
		if($("tr.linhasdiversos").length > 1){//se o numero de linhas for maior que 1
			$(this).parent().parent().remove();//ele vai remover a linha selecionada
		}else{
			alert("A última linha não pode ser removida.");
		}
	});
}

$(".adicionarCampodiversos").click(function (){
	novoCampo = $("tr.linhasdiversos:first").clone();//clona linha
	novoCampo.find("input").val("");//dar valores zero para cada input
	var idAnterior = parseInt($("tr.linhasdiversos:last").attr('id').replace('id__', ''));//atribui id com valor inteiro para a ultima linha adicionada.
	var idAtual = idAnterior+1; //valor da linha atual é mais ul da anterior
	novoCampo.attr('id', 'id__'+idAtual); //da o valor da linha adicionada ex.:1, 2,..., 8.
	novoCampo.insertAfter("tr.linhasdiversos:last");//inseri a nova linha a partir da linha anterior
	removeCampodiversos();//nessa linha se é chamada a function removeCampodiversos()
});

});

 function validaDetalhediversos(){
   //recebe os valores preenchidos das marca
   var categoriapValidar = document.getElementsByName('selcategoriasp[]');
   //recebe os valores preenchidos das categorias
   var marcapValidar   = document.getElementsByName('selmarcasp[]');
   //recebe os valores preenchidos dos produtos
   var produtopValidar = document.getElementsByName('selprodutosp[]');
   //recebe os valores preenchidos dos produtos
   var quantidadepValidar = document.getElementsByName('txtquantindadep[]');
   //estrutura para-faça para repetir a validação enquanto contadora for menor que tamanho do array, sendo que contadora começa de 0 e tem incremento 1
   for(var contadora = 0; contadora < categoriapValidar.length; contadora++){
     //cria variável linha com valor de contadora +1 para a mensagem avisar corretamente qual campo não foi preenchido
     var linha = contadora+1;
     //se a posição atual dos arrays de categoria ou produto estiverem vazios
     if((categoriapValidar[contadora].value=="")||(marcapValidar[contadora].value=="")||(produtopValidar[contadora].value=="")||(quantidadepValidar[contadora].value=="")){
       alert("A linha "+linha+" não foi totalmente preenchida.");
       return false;
     }
   }
 }
