<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="style/style.css"> -->
    <title>Cadastro</title>
</head>
<body>
    <form action="cadastro.php" method="POST">
        <label for="email">E-mail:</label> <br>
        <input type="email" id="email" name="email" required> <br> <br>

        <label for="senha">Senha:</label> <br>
        <input type="password" id="senha" name="senha" required> <br> <br>

        <button type="submit" name="submit">Enviar</button>
    </form>
</body>
</html>

<?php

include_once("config.php"); // Inclua o arquivo de configuração do banco de dados

if (isset($_POST["submit"])) {
    // Sanitização das entradas
    $email = mysqli_real_escape_string($conexao, $_POST["email"]);
    $senha = mysqli_real_escape_string($conexao, $_POST["senha"]);

    // Hash da senha para segurança
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // Verifica se o e-mail já está cadastrado
    $verificarEmail = mysqli_query($conexao, "SELECT * FROM usuarios WHERE email = '$email'");
    if (mysqli_num_rows($verificarEmail) > 0) {
        echo 
        "<script type='text/javascript'>
            alert('E-mail já cadastrado!');
            window.location.href = 'cadastro.php';
        </script>";
        exit();
    }

    // Insere o novo usuário no banco de dados
    $enviar = mysqli_query($conexao, "INSERT INTO usuarios (email, senha) VALUES ('$email', '$senhaHash')");

    if ($enviar) {
        echo 
        "<script type='text/javascript'>
            alert('Usuário cadastrado com sucesso!');
            window.location.href = 'login.php';
        </script>";
    } else {
        echo 
        "<script type='text/javascript'>
            alert('Não foi possível cadastrar esse usuário.');
            window.location.href = 'cadastro.php';
        </script>";
    }
}

?>
