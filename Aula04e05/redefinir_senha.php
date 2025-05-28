<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <!-- Incluindo o arquivo CSS -->
    <link rel="stylesheet" href="style/redefinir_senha.css">
</head>
<body>
    <h1>Redefinir Senha</h1>
    <form action="redefinir_senha.php" method="POST">
        <!-- Campo para nova senha -->
        <label for="nova_senha">Nova Senha:</label> <br>
        <input type="password" id="nova_senha" name="nova_senha" required> <br> <br>

        <!-- Campo para confirmar nova senha -->
        <label for="confirmar_senha">Confirmar Nova Senha:</label> <br>
        <input type="password" id="confirmar_senha" name="confirmar_senha" required> <br> <br>

        <!-- Botão para alterar a senha -->
        <button type="submit" name="alterar_senha">Alterar Senha</button>
    </form>
</body>
</html>

<?php
session_start(); // Iniciar a sessão para acessar dados armazenados
include_once("config.php"); // Inclua o arquivo de configuração do banco de dados

// Verificar se o e-mail principal está na sessão
if (!isset($_SESSION['email_principal'])) {
    echo "Erro: Nenhum e-mail principal foi encontrado.<br>";
    echo "<a href='recuperacao.php'>Voltar para a página de recuperação.</a>";
    exit();
}

if (isset($_POST['alterar_senha'])) {
    $nova_senha = $_POST['nova_senha'];
    $confirmar_senha = $_POST['confirmar_senha'];
    $email_principal = $_SESSION['email_principal']; // Obtenha o e-mail principal salvo na sessão

    // Verificar se as senhas correspondem
    if ($nova_senha !== $confirmar_senha) {
        echo "As senhas não correspondem. Tente novamente.<br>";
        echo "<a href='redefinir_senha.php'>Voltar para tentar novamente.</a>";
        exit();
    }

    // Hash da nova senha para segurança
    $nova_senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);

    // Atualizar senha no banco de dados
    $atualizar = mysqli_query($conexao, "UPDATE usuarios SET senha = '$nova_senha_hash' WHERE email = '$email_principal'");

    if ($atualizar) {
        echo "Senha alterada com sucesso!<br>";
        echo "<a href='login.php'>Clique aqui para fazer login.</a>";
    } else {
        echo "Erro ao alterar a senha. Tente novamente.<br>";
    }
}
?>