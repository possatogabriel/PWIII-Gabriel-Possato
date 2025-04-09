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

        <label for="nome">Nome:</label> <br>
        <input type="text" id="nome" name="nome" required> <br> <br>

        <label for="email">E-mail:</label> <br>
        <input type="email" id="email" name="email" required> <br> <br>

        <label for="email_recuperacao">E-mail de Recuperação:</label> <br>
        <input type="email" id="email_recuperacao" name="email_recuperacao" required> <br> <br>

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
    $nome = mysqli_real_escape_string($conexao, $_POST["nome"]);
    $email = mysqli_real_escape_string($conexao, $_POST["email"]);
    $emailRecuperacao = mysqli_real_escape_string($conexao, $_POST["email_recuperacao"]);
    $senha = mysqli_real_escape_string($conexao, $_POST["senha"]);
    $data_cad = date('Y/m/d');

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

    // Insere o novo usuário no banco de dados com as novas informações
    $enviar = mysqli_query($conexao, "INSERT INTO usuarios (nome, email, email_recup, senha, data_cad) VALUES ('$nome', '$email', '$emailRecuperacao', '$senhaHash', '$data_cad')");

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

