<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de Senha</title>
    <!-- Incluindo o arquivo CSS -->
    <link rel="stylesheet" href="style/recuperacao.css">
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
session_start(); // Iniciar a sessão para armazenar dados temporários
include_once("config.php"); // Inclua o arquivo de configuração do banco de dados

if (isset($_POST['enviar_codigo'])) {
    // Obter o e-mail de recuperação inserido pelo usuário
    $email_recuperacao = mysqli_real_escape_string($conexao, $_POST['email_recuperacao']);

    // Verificar se o e-mail de recuperação existe no banco de dados
    $consulta = mysqli_query($conexao, "SELECT email FROM usuarios WHERE email_recup = '$email_recuperacao'");

    if ($consulta && mysqli_num_rows($consulta) > 0) {
        // Obter o e-mail principal do usuário
        $usuario = mysqli_fetch_assoc($consulta);
        $email_principal = $usuario['email'];

        // Salvar o e-mail principal e o de recuperação na sessão
        $_SESSION['email_recuperacao'] = $email_recuperacao;
        $_SESSION['email_principal'] = $email_principal;

        // Gerar um código aleatório
        $codigo = rand(100000, 999999);

        // Salvar o código na sessão
        $_SESSION['codigo_recuperacao'] = $codigo;

        // Mostrar o código diretamente na página (apenas para teste, remova isso em produção)
        echo "Seu código de recuperação é: <strong>" . $_SESSION['codigo_recuperacao'] . "</strong><br><br>";
    } else {
        // E-mail de recuperação não encontrado
        echo "O e-mail de recuperação inserido não está registrado no sistema.<br>";
        echo "<a href='recuperacao.php'>Voltar para a página de recuperação.</a>";
    }
}
?>