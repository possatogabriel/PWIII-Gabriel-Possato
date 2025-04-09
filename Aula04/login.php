<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form method="POST" action="login.php">
        <label>Login:</label> 
        <input type="email" name="email" id="email" required> <br>
        
        <label>Senha:</label> 
        <input type="password" name="senha" id="senha" required> <br>
        
        <input type="submit" value="Entrar" id="entrar" name="entrar"> <br>
        <a href="cadastro.php">Cadastre-se</a>
        <a href="recuperacao.php"> Esqueceu sua senha? </a>
    </form>
</body>
</html>

<?php

include_once("config.php"); // Inclua o arquivo de configuração do banco de dados

if (isset($_POST["entrar"])) {
    // Sanitização das entradas para evitar SQL Injection
    $email = mysqli_real_escape_string($conexao, $_POST["email"]);
    $senha = mysqli_real_escape_string($conexao, $_POST["senha"]);

    // Consulta ao banco de dados
    $consulta = mysqli_query($conexao, "SELECT * FROM usuarios WHERE email = '$email'");

    if (!$consulta) {
        die("Erro ao fazer a consulta no banco: " . mysqli_error($conexao));
    }

    if (mysqli_num_rows($consulta) > 0) {
        // Verificar a senha com hash
        $usuario = mysqli_fetch_assoc($consulta);
        if (password_verify($senha, $usuario["senha"])) {
            // Login bem-sucedido, criar cookie e redirecionar
            setcookie("login", $email, time() + (86400 * 30), "/"); // Cookie válido por 30 dias
            header("Location: index.php");
            exit();
        } else {
            // Senha incorreta
            echo 
            "<script type='text/javascript'> 
                alert('Senha incorreta!');
                window.location.href = 'login.php';
            </script>";
            exit();
        }
    } else {
        // Usuário não encontrado
        echo 
        "<script type='text/javascript'> 
            alert('Usuário não encontrado!');
            window.location.href = 'cadastro.php';
        </script>";
        exit();
    }
}

?>
