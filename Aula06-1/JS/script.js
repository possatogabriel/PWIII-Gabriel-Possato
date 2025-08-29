function exibirDataAtual() {
    const dataAtual = new Date();
    const textoData = document.getElementById('dataAtual');
    textoData.textContent = dataAtual.toLocaleDateString('pt-BR');
}

function alterarCorDoTexto() {
    const cor = document.getElementById('corTexto').value;
    
    document.querySelector('.container').style.color = cor;
    document.querySelectorAll('.buttons a').forEach(function(btn) {
        btn.style.backgroundColor = cor;
    });
}

function alterarCorDoPainel() {
    const cor = document.getElementById('corPainel').value;

    document.querySelector('.container').style.backgroundColor = cor;
    document.querySelectorAll('.buttons a').forEach(function(btn) {
        btn.style.color = cor;
    });
}

function alterarCorDoFundo() {
    const cor = document.getElementById('corFundo').value;

    document.body.style.backgroundColor = cor;
}

exibirDataAtual();

document.getElementById('corTexto').addEventListener('input', alterarCorDoTexto);

document.getElementById('corPainel').addEventListener('input', alterarCorDoPainel);

document.getElementById('corFundo').addEventListener('input', alterarCorDoFundo);