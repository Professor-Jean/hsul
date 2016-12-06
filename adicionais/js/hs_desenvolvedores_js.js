
  var popup = document.getElementById('popup');

  var botao = document.getElementById('linkpopup');

  var fechar = document.getElementsByClassName('fechar')[0];

  botao.onclick = function() {
    popup.style.display = "block";
  }

  fechar.onclick = function() {
    popup.style.display = "none";
  }

  window.onclick = function(event) {
    if (event.target == popup) {
      popup.style.display = "none";
    }
  }
