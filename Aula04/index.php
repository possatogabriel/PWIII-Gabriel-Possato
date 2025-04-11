<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-Vindo</title>
    <!-- Incluindo o arquivo CSS -->
    <link rel="stylesheet" href="style/index.css">
</head>
<body>
    <div class="container">
        <?php
        include_once("config.php"); // Inclua seu arquivo de configuração do banco de dados

        // Verifica se o cookie de login existe
        $login_cookie = isset($_COOKIE["login"]) ? $_COOKIE["login"] : null;

        if ($login_cookie) {
            // Valida o cookie contra o banco de dados
            $consulta = mysqli_query($conexao, "SELECT * FROM usuarios WHERE email = '$login_cookie'");
            if ($consulta && mysqli_num_rows($consulta) > 0) {
                // Recupera os dados do usuário
                $usuario = mysqli_fetch_assoc($consulta);
                $nome = htmlspecialchars($usuario["nome"]); // Nome do usuário

                // Cookie é válido e exibe o nome
                echo "Bem-Vindo, " . $nome . "<br>";
                echo "Essas informações <font color='red'>PODEM</font> ser acessadas por você.";
            } else {
                // Cookie inválido ou usuário não encontrado
                echo "Cookie inválido ou expirado. <br>";
                echo "<a href='login.php'>Faça Login</a> novamente.";
            }
        } else {
            // Cookie não existe
            echo "Bem-Vindo, convidado.<br>";
            echo "Essas informações <font color='red'>NÃO PODEM</font> ser acessadas por você.<br>";
            echo "<a href='login.php'>Faça Login</a> para ler o conteúdo.";
        }
        ?>
    </div>
</body>
</html>