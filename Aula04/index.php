<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title> Atividade PHP </title>
</head>
<body>
    <form action = "index.php" method = "POST">
        <label for = "email"> E-mail: </label> <br>
        <input type = "email" id = "email" name = "email" required> <br> <br>

        <label for = "senha"> Senha: </label> <br>
        <input type = "password" id = "senha" name = "senha" required> <br> <br>

        <button type = "submit" name = "submit"> Enviar </button>
    </form>
</body>
</html>

<?php

include_once("config.php");

if(isset($_POST["submit"])) {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $enviar = mysqli_query($conexao, "INSERT INTO usuarios (email, senha) VALUES ('$email', '$senha')");
}

?>