window.addEventListener('DOMContentLoaded', function() {
    const corTexto = getCookie('corTexto');
    const corPainel = getCookie('corPainel');
    const corFundo = getCookie('corFundo');

    if (corTexto) {
        document.querySelector('.container').style.color = corTexto;

        const inputTexto = document.getElementById('corTexto');
        if (inputTexto) {
            inputTexto.value = corTexto;
            // ALTERAÇÕES ESPECÍFICAS DO INDEX.HTML
            document.querySelectorAll('.buttons a').forEach(function(btn) {
                btn.style.backgroundColor = corTexto;
            });
        }

        // ALTERAÇÕES ESPECÍFICAS DO CADASTRAR.PHP
        document.querySelectorAll('.linha label').forEach(function(label) {
            label.style.color = corTexto;
        });
        document.querySelectorAll('.linha input').forEach(function(input) {
            input.style.backgroundColor = corTexto;
        });
        const submitBtn = document.querySelector('.container form input[type="submit"]');
        if (submitBtn) submitBtn.style.backgroundColor = corTexto;

        const voltarLink = document.querySelector('.voltar');
        if (voltarLink) voltarLink.style.color = corTexto;

        // ALTERAÇÕES ESPECÍFICAS DO CONSULTAR.PHP
        const fundoThead = document.querySelector('thead');
        if (fundoThead) fundoThead.style.backgroundColor = corTexto;

        const dadoTabela = document.querySelectorAll('td');
        if (dadoTabela) dadoTabela.forEach(function(td) {
            td.style.color = corTexto;
            td.style.borderColor = corTexto;
        });
    }

    if (corPainel) {
        document.querySelector('.container').style.backgroundColor = corPainel;

        // ALTERAÇÕES ESPECÍFICAS DO CADASTRAR.PHP
        const inputPainel = document.getElementById('corPainel');
        if (inputPainel) inputPainel.value = corPainel;

        document.querySelectorAll('.linha input[type="text"]').forEach(function(input) {
            input.style.color = corPainel;
        });

        const submitBtn = document.querySelector('.container form input[type="submit"]');
        if (submitBtn) submitBtn.style.color = corPainel;

        // ALTERAÇÕES ESPECÍFICAS DO INDEX.HTML
        document.querySelectorAll('.buttons a').forEach(function(btn) {
            btn.style.color = corPainel;
        });

        const corThead = document.querySelector('thead');
        if (corThead) corThead.style.color = corPainel;
    }

    if (corFundo) {
        document.body.style.backgroundColor = corFundo;

        const inputFundo = document.getElementById('corFundo');
        if (inputFundo) inputFundo.value = corFundo;
    }

    exibirDataAtual();
});

// Exibe a data atual
function exibirDataAtual() {
    const dataAtual = new Date();
    const textoData = document.getElementById('dataAtual');
    if (textoData) {
        textoData.textContent = dataAtual.toLocaleDateString('pt-BR');
    }
}

function alterarCorDoTexto() {
    const cor = document.getElementById('corTexto').value;
    setCookie('corTexto', cor);

    document.querySelector('.container').style.color = cor;
    document.querySelectorAll('.buttons a').forEach(function(btn) {
        btn.style.backgroundColor = cor;
    });
}

function alterarCorDoPainel() {
    const cor = document.getElementById('corPainel').value;
    setCookie('corPainel', cor);

    document.querySelector('.container').style.backgroundColor = cor;
    document.querySelectorAll('.buttons a').forEach(function(btn) {
        btn.style.color = cor;
    });
}

function alterarCorDoFundo() {
    const cor = document.getElementById('corFundo').value;
    setCookie('corFundo', cor);

    document.body.style.backgroundColor = cor;
}

// Cookies
function setCookie(cname, cvalue) {
    const d = new Date();
    d.setTime(d.getTime() + (1 * 24 * 60 * 60 * 1000)); // 1 dia
    const expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    const name = cname + "=";
    const decodedCookie = decodeURIComponent(document.cookie);
    const ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) === ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) === 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

const inputTexto = document.getElementById('corTexto');
if (inputTexto) inputTexto.addEventListener('input', alterarCorDoTexto);

const inputPainel = document.getElementById('corPainel');
if (inputPainel) inputPainel.addEventListener('input', alterarCorDoPainel);

const inputFundo = document.getElementById('corFundo');
if (inputFundo) inputFundo.addEventListener('input', alterarCorDoFundo);