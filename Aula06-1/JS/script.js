window.onload = function() {
    const dataAtual = new Date();
    const textoData = document.getElementById('dataAtual');
    textoData.textContent = dataAtual.toLocaleDateString('pt-BR');

    document.getElementById('corTexto').addEventListener('input', alterarCorDoTexto);

    document.getElementById('corFundo').addEventListener('input', alterarCorDoFundo);
}

function alterarCorDoTexto() {
    const cor = document.getElementById('corTexto').value;
    
    document.querySelector('.container').style.color = cor;
    document.querySelectorAll('.buttons a').forEach(function(btn) {
        btn.style.backgroundColor = cor;
    });
}

function alterarCorDoFundo() {
    const cor = document.getElementById('corFundo').value;

    document.querySelector('.container').style.backgroundColor = cor;
    document.querySelectorAll('.buttons a').forEach(function(btn) {
        btn.style.color = cor;
    });
}