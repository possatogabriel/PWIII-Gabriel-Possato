<?php
session_start();
include_once("config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

    $query = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'";
    $resultado = mysqli_query($conexao, $query);

    if (mysqli_num_rows($resultado) == 1) {
        $_SESSION['usuario_logado'] = $usuario;
        header("Location: inicio.php");
        exit;
    } else {
        header("Location: login.php?erro=1");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <title>Webcar</title>
</head>
<body>
    <div class="container">
        <div class="texts">
            <h1>Login</h1>
        </div>

        <?php if (isset($_GET['erro'])): ?>
            <div class="mensagem erro">
                Usuário ou senha inválidos. Tente novamente.
            </div>
        <?php endif ?>

        <form method="POST" action="login.php">
            <div class="linha">
                <label for="usuario">Usuário:</label>
                <input type="text" id="usuario" name="usuario" required>
            </div>

            <div class="linha">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>

            <input type="submit" value="Entrar">
            <a href="index.php" class="voltar">Voltar</a>
        </form>
    </div>

    <script src="js/script.js"></script>
</body>
</html>