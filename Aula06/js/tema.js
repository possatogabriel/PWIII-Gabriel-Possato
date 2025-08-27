function exibirDataAtual() {
    const hoje = new Date();
    const dia = String(hoje.getDate()).padStart(2, '0');
    const mes = String(hoje.getMonth() + 1).padStart(2, '0');
    const ano = hoje.getFullYear();
    const dataFormatada = `${dia}-${mes}-${ano}`;
    const dataEl = document.getElementById("data-atual");
    if (dataEl) dataEl.textContent = `DATA DE HOJE: ${dataFormatada}`;
}

function aplicarCorTema(cor) {
    document.querySelector("h2").style.color = cor;
    document.querySelectorAll("label").forEach(label => label.style.color = cor);
    document.querySelector(".data-atual").style.color = cor;
    const botao = document.querySelector("input[type='submit']");
    if (botao) botao.style.backgroundColor = cor;
}

function aplicarCorFundo(cor) {
    document.body.style.backgroundColor = cor;
}

function aplicarCorContainer(cor) {
    const container = document.querySelector(".container");
    if (container) container.style.backgroundColor = cor;
}

function lerCookie(nome) {
    const valor = document.cookie.match('(^|;)\\s*' + nome + '\\s*=\\s*([^;]+)');
    return valor ? valor.pop() : "";
}

window.onload = function () {
    exibirDataAtual();

    const corTema = lerCookie("foreground") || "#e66465";
    const corFundo = lerCookie("background") || "#121212";
    const corContainer = lerCookie("containerColor") || "#1e1e1e";

    aplicarCorTema(corTema);
    aplicarCorFundo(corFundo);
    aplicarCorContainer(corContainer);

    const fgInput = document.getElementById("foreground");
    if (fgInput) {
        fgInput.value = corTema;
        fgInput.addEventListener("input", function () {
            aplicarCorTema(this.value);
            document.cookie = `foreground=${this.value}; path=/`;
        });
    }

    const bgInput = document.getElementById("background");
    if (bgInput) {
        bgInput.value = corFundo;
        bgInput.addEventListener("input", function () {
            aplicarCorFundo(this.value);
            document.cookie = `background=${this.value}; path=/`;
        });
    }

    const containerInput = document.getElementById("containerColor");
    if (containerInput) {
        containerInput.value = corContainer;
        containerInput.addEventListener("input", function () {
            aplicarCorContainer(this.value);
            document.cookie = `containerColor=${this.value}; path=/`;
        });
    }
};
