<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Incluindo o arquivo CSS -->
    <link rel="stylesheet" href="style/login.css">
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
include_once("config.php"); // Inclui a configuração do banco de dados

if (isset($_POST['entrar'])) {
    // Obter dados do formulário
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = $_POST['senha'];

    // Validação do comprimento da senha
    if (strlen($senha) > 8) {
        echo "Erro: A senha não pode ter mais de 8 caracteres.<br>";
        exit();
    }

    // Verificar o e-mail no banco de dados
    $consulta = mysqli_query($conexao, "SELECT * FROM usuarios WHERE email = '$email'");

    if ($consulta && mysqli_num_rows($consulta) > 0) {
        // Validar a senha
        $usuario = mysqli_fetch_assoc($consulta);
        if (password_verify($senha, $usuario['senha'])) {
            // Login bem-sucedido
            setcookie("login", $email, time() + (86400 * 30), "/"); // Cookie válido por 30 dias
            header("Location: index.php");
            exit();
        } else {
            echo "<script type='text/javascript'>
                    alert('Senha incorreta!');
                    window.location.href = 'login.php';
                  </script>";
            exit();
        }
    } else {
        echo "<script type='text/javascript'>
                alert('Usuário não encontrado!');
                window.location.href = 'cadastro.php';
              </script>";
        exit();
    }
}
?>

