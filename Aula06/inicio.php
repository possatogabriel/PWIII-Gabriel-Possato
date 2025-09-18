<?php
session_start(); 

if (!isset($_SESSION['usuario_logado'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/inicio.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <title>Webcar</title>
</head>
<body>
    <div class="container">
        <div class="texts">
            <p id="dataAtual"></p>
            <h1>Tela Inicial</h1>
        </div>

        <div class="buttons">
            <a href="cadastrar.php">Fazer cadastro</a>
            <a href="editar.php">Editar cadastro</a>
            <a href="consultar.php">Ver consulta</a>

            <div class="cores">
                <div class="linha">
                    <p>Alterar cor do texto e botões:</p>
                    <input type="color" id="corTexto" value="#ffffff">
                </div>

                <div class="linha">
                    <p>Alterar cor do painel:</p>
                    <input type="color" id="corPainel" value="#000000"/>
                </div>

                <div class="linha">
                    <p>Alterar cor do fundo:</p>
                    <input type="color" id="corFundo" value="#ffffff"/>
                </div>
            </div>

            <a href="config/logout.php">Logout</a>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>
</html>