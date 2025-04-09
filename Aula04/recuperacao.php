<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de Senha</title>
</head>
<body>
    <form action="recuperacao.php" method="POST">
        <!-- Campo para e-mail de recuperação -->
        <label for="email_recuperacao">E-mail de Recuperação:</label> <br>
        <input type="email" id="email_recuperacao" name="email_recuperacao" required> <br> <br>

        <!-- Botão para gerar o código -->
        <button type="submit" name="enviar_codigo">Gerar Código</button> <br> <br>
    </form>

    <form action="validar_codigo.php" method="POST">
        <!-- Campo para inserir o código recebido -->
        <label for="codigo">Código:</label> <br>
        <input type="text" id="codigo" name="codigo" required> <br> <br>

        <!-- Botão para validar o código e realizar a troca de senha -->
        <button type="submit" name="validar_codigo">Validar Código</button>
    </form>
</body>
</html>

<?php
session_start(); // Iniciar a sessão para armazenar o código gerado
if (isset($_POST['enviar_codigo'])) {
    // Gerar um código aleatório
    $codigo = rand(100000, 999999);

    // Salvar o código na sessão
    $_SESSION['codigo_recuperacao'] = $codigo;

    // Mostrar o código diretamente na página
    echo "Seu código de recuperação é: <strong>" . $_SESSION['codigo_recuperacao'] . "</strong><br><br>";
}
?>
